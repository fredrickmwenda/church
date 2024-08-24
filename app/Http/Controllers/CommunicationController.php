<?php

namespace App\Http\Controllers;

use App\Helpers\GeneralHelper;
use App\Helpers\RouteSms;
use App\Helpers\Infobip;
use App\Models\Member;
use App\Models\Email;
use App\Models\Setting;
use App\Models\Sms;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Clickatell\Rest;
use Illuminate\Http\Request;
use Aloha\Twilio\Twilio;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Laracasts\Flash\Flash;
use Yajra\DataTables\Facades\DataTables;

class CommunicationController extends Controller
{
    public function __construct()
    {
        $this->middleware('sentinel');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexEmail()
    {
        if (!Sentinel::hasAccess('communication')) {
            Flash::warning("Permission Denied");
            return redirect()->back();
        }
        $data['emails'] = Email::all();
        return view('communication.email', $data);
    }

    public function get_emails(Request $request)
    {
        if (!Sentinel::hasAccess('communication')) {
            Flash::warning("Permission Denied");
            return redirect()->back();
        }
        $query = DB::table("emails")->leftJoin("users", "users.id", "emails.user_id")->selectRaw(DB::raw('emails.*, users.first_name first_name,users.last_name last_name'));
        return DataTables::of($query)->editColumn('user', function ($data) {
            return $data->first_name . ' ' . $data->last_name;
        })->editColumn('action', function ($data) {
            $action = '<div class="btn-group"><button type="button" class="btn btn-info btn-flat dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-list"></i></button><ul class="dropdown-menu dropdown-menu-right" role="menu">';
            if (Sentinel::hasAccess('communication.delete')) {
                $action .= '<li class="sentiment"><a href="' . url('communication/email/' . $data->id . '/delete') . '" class="delete">' . trans_choice('general.delete', 2) . '</a></li>';
            }
            $action .= "</ul></div>";
            return $action;
        })->rawColumns(['id', 'user', 'message', 'action'])->make(true);
    }

    public function indexSms()
    {
        if (!Sentinel::hasAccess('communication')) {
            Flash::warning("Permission Denied");
            return redirect()->back();
        }

        $data = Sms::all();

        return view('communication.sms', compact('data'));
    }

    public function get_sms(Request $request)
    {
        if (!Sentinel::hasAccess('communication')) {
            Flash::warning("Permission Denied");
            return redirect()->back();
        }
        $query = DB::table("sms")->leftJoin("users", "users.id", "sms.user_id")->selectRaw(DB::raw('sms.*, users.first_name first_name,users.last_name last_name'));
        return DataTables::of($query)->editColumn('user', function ($data) {
            return $data->first_name . ' ' . $data->last_name;
        })->editColumn('action', function ($data) {
            $action = '<div class="btn-group"><button type="button" class="btn btn-info btn-flat dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-list"></i></button><ul class="dropdown-menu dropdown-menu-right" role="menu">';
            if (Sentinel::hasAccess('communication.delete')) {
                $action .= '<li class="sentiment"><a href="' . url('communication/email/' . $data->id . '/delete') . '" class="delete">' . trans_choice('general.delete', 2) . '</a></li>';
            }
            $action .= "</ul></div>";
            return $action;
        })->rawColumns(['id', 'user', 'action'])->make(true);
    }

    public function createEmail(Request $request)
    {
        if (!Sentinel::hasAccess('communication.create')) {
            Flash::warning("Permission Denied");
            return redirect()->back();
        }
        $members = array();
        $members["0"] = trans_choice('general.all', 2) . ' ' . trans_choice('general.member', 2);
        foreach (Member::all() as $key) {
            $members[$key->id] = $key->first_name . ' ' . $key->middle_name . ' ' . $key->last_name . '(' . $key->id . ')';
        }
        if (isset($request->member_id)) {
            $selected = $request->member_id;
        } else {
            $selected = '';
        }
        return view('communication.create_email', compact('members', 'selected'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function storeEmail(Request $request)
    {
        if (!Sentinel::hasAccess('communication.create')) {
            Flash::warning("Permission Denied");
            return redirect()->back();
        }

        $body = $request->message;
        $recipients = 1;
        if ($request->send_to == 0) {
            foreach (Member::all() as $member) {
                $body = $request->message;
                //lets build and replace available tags
                $body = str_replace('{firstName}', $member->first_name, $body);
                $body = str_replace('{middleName}', $member->middle_name, $body);
                $body = str_replace('{lastName}', $member->last_name, $body);
                $body = str_replace('{address}', $member->address, $body);
                $body = str_replace('{homePhone}', $member->home_phone, $body);
                $body = str_replace('{mobilePhone}', $member->mobile_phone, $body);
                $body = str_replace('{email}', $member->email, $body);
                $email = $member->email;
                if (!empty($email)) {
                    Mail::send([], [], function ($message) use ($body, $request, $email) {
                        $message->to($email)
                            ->subject($request->subject)
                            ->from(
                                Setting::where('setting_key', 'company_email')->first()->setting_value,
                                Setting::where('setting_key', 'company_name')->first()->setting_value
                            )
                            ->setBody($body, 'text/html');
                    });
                }
                $recipients = $recipients + 1;
            }
            $mail = new Email();
            $mail->user_id = Sentinel::getUser()->id;
            $mail->message = $body;
            $mail->subject = $request->subject;
            $mail->recipients = $recipients;
            $mail->send_to = 'All Members';
            $mail->save();
            GeneralHelper::audit_trail("Send  email to all members");
            Flash::success("Email successfully sent");
            return redirect('communication/email');
        } else {

            $member = Member::find($request->send_to);

            //lets build and replace available tags
            $body = str_replace('{firstName}', $member->first_name, $body);
            $body = str_replace('{middleName}', $member->middle_name, $body);
            $body = str_replace('{lastName}', $member->last_name, $body);
            $body = str_replace('{address}', $member->address, $body);
            $body = str_replace('{homePhone}', $member->home_phone, $body);
            $body = str_replace('{mobilePhone}', $member->mobile_phone, $body);
            $body = str_replace('{email}', $member->email, $body);
            // if (!empty($email)) {
            if (!empty($member->email)) {

                // Mail::send([], [], function ($message) use ($body, $request, $email) {
                //     $message->to($email)
                //         ->subject($request->subject)
                //         ->from(
                //             Setting::where('setting_key', 'company_email')->first()->setting_value,
                //             Setting::where('setting_key', 'company_name')->first()->setting_value
                //         )
                //         ->setBody($body, 'text/html');
                // });

                //** SENDING NOTIFICATIONS EMAIL */
                $appDomaine = str_replace("http:", "", env('APP_URL'));
                $appDomaine = str_replace("/", "", $appDomaine);
                $appDomaine = str_replace("https:", "", $appDomaine);
                $appDomaine = str_replace("/", "", $appDomaine);
                $company_email = Setting::where('setting_key', 'company_email')->first()->setting_value;
                $company_name = Setting::where('setting_key', 'company_name')->first()->setting_value;

                $mail =  Mail::send('emails.notifications_email_template', array(

                    'mail_type' => "email",
                    'first_name' => $member->first_name,
                    'last_name' => $member->last_name,
                    'the_message' => $body,

                    'email' => $member->email,
                ), function ($message) use ($request, $member, $company_name, $company_email, $appDomaine) {
                    $message->from($company_email, $company_name);
                    $message->to($member->email, "$member->first_name $member->last_name")
                        ->subject($request->subject . " :: " . env('APP_NAME'));
                });

                $mail = new Email();
                $mail->user_id = Sentinel::getUser()->id;
                $mail->message = $body;
                $mail->subject = $request->subject;
                $mail->recipients = $recipients;
                $mail->send_to = $member->first_name . ' ' . $member->last_name;
                $mail->save();
                GeneralHelper::audit_trail("Sent email to member ");
                Flash::success("Email successfully sent");
                return redirect('communication/email');
            }
        }
        Flash::success("Email successfully sent");
        return redirect('communication/email');
    }


    public function deleteEmail($id)
    {
        if (!Sentinel::hasAccess('communication.delete')) {
            Flash::warning("Permission Denied");
            return redirect()->back();
        }
        Email::destroy($id);
        GeneralHelper::audit_trail("Deleted email record with id:" . $id);
        Flash::success("Email successfully deleted");
        return redirect('communication/email');
    }

    public function createSms(Request $request)
    {
        if (!Sentinel::hasAccess('communication.create')) {
            Flash::warning("Permission Denied");
            return redirect()->back();
        }
        $members = array();
        $members["0"] = trans_choice('general.all', 2) . ' ' . trans_choice('general.member', 2);
        foreach (Member::all() as $key) {
            $members[$key->id] = $key->first_name . ' ' . $key->middle_name . ' ' . $key->last_name . '(' . $key->id . ')';
        }
        if (isset($request->member_id)) {
            $selected = $request->member_id;
        } else {
            $selected = '';
        }
        return view('communication.create_sms', compact('members', 'selected'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function storeSms(Request $request)
    {
        if (!Sentinel::hasAccess('communication.create')) {
            Flash::warning("Permission Denied");
            return redirect()->back();
        }
    
        $body = $request->message;
        $recipients = 1;
        
        if (Setting::where('setting_key', 'sms_enabled')->first()->setting_value == 1) {
            if ($request->send_to == 0) {
                $active_sms = Setting::where('setting_key', 'active_sms')->first()->setting_value;
                foreach (Member::all() as $member) {
                    // Replace available tags
                    $body = str_replace(['{firstName}', '{middleName}', '{lastName}', '{address}', '{homePhone}', '{mobilePhone}', '{email}'],
                                        [$member->first_name, $member->middle_name, $member->last_name, $member->address, $member->home_phone, $member->mobile_phone, $member->email],
                                        $body);
                    $body = trim(strip_tags($body));
                    if (!empty($member->mobile_phone)) {
                        $result = GeneralHelper::send_sms($member->mobile_phone, $body);
                        if (!$result['success']) {
                            Flash::error($result['message']);
                            return redirect()->back();
                        }
                    }
                    $recipients++;
                }
    
                $sms = new Sms();
                $sms->user_id = Sentinel::getUser()->id;
                $sms->message = $body;
                $sms->gateway = $active_sms;
                $sms->recipients = $recipients;
                $sms->send_to = 'All members';
                $sms->save();
    
                GeneralHelper::audit_trail("Sent SMS to all members");
                Flash::success("SMS successfully sent");
                return redirect('communication/sms');
            } else {
                $member = Member::find($request->send_to);
    
                // Replace available tags
                $body = str_replace(['{firstName}', '{middleName}', '{lastName}', '{address}', '{homePhone}', '{mobilePhone}', '{email}'],
                                    [$member->first_name, $member->middle_name, $member->last_name, $member->address, $member->home_phone, $member->mobile_phone, $member->email],
                                    $body);
                $body = trim(strip_tags($body));
    
                if (!empty($member->mobile_phone)) {
                    $result = GeneralHelper::send_sms($member->mobile_phone, $body);
                    if (!$result['success']) {
                        Flash::error($result['message']);
                        return redirect()->back();
                    }
    
                    $sms = new Sms();
                    $sms->user_id = Sentinel::getUser()->id;
                    $sms->message = $body;
                    $sms->gateway = Setting::where('setting_key', 'active_sms')->first()->setting_value;
                    $sms->recipients = $recipients;
                    $sms->send_to = $member->first_name . ' ' . $member->last_name;
                    $sms->save();
    
                    Flash::success("SMS successfully sent");
                    return redirect('communication/sms');
                }
            }
            GeneralHelper::audit_trail("Sent SMS to member");
            Flash::success("Sms successfully sent");
            return redirect('communication/sms');
        } else {
            Flash::warning('SMS service is disabled, please go to settings and enable it');
            return redirect('setting/data')->with(array('error' => 'SMS is disabled, please enable it.'));
        }
    }
    


    public function deleteSms($id)
    {
        if (!Sentinel::hasAccess('communication.delete')) {
            Flash::warning("Permission Denied");
            return redirect()->back();
        }
        Sms::destroy($id);
        GeneralHelper::audit_trail("Deleted sms record with id:" . $id);
        Flash::success("SMS successfully deleted");
        return redirect('communication/sms');
    }
}
