<?php

namespace App\Http\Controllers;

use Aloha\Twilio\Twilio;
use App\Helpers\GeneralHelper;

use App\Models\Branch;
use App\Models\CustomField;
use App\Models\CustomFieldMeta;
use App\Models\Email;
use App\Models\Family;
use App\Models\FamilyMember;
use App\Models\Member;
use App\Models\MemberTag;
use App\Models\Setting;
use App\Models\Tag;
use App\Models\User;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use PDF;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Laracasts\Flash\Flash;
use Yajra\DataTables\Facades\DataTables;

// ADD BY JOJO
use App\Models\Cell;
// ADD BY JOJO

class MemberController extends Controller
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
    public function index()
    {
        if (!Sentinel::hasAccess('members')) {
            Flash::warning("Permission Denied");
            return redirect()->back();
        }

        return view('member.data');
    }

    public function get_members(Request $request)
    {
        if (!Sentinel::hasAccess('members')) {
            Flash::warning("Permission Denied");
            return redirect()->back();
        }
        $query = Member::leftJoin('branches', 'branches.id', 'members.branch_id')
            ->selectRaw('members.*,branches.name branch');
        return DataTables::of($query)->editColumn('name', function ($data) {
            return '<a href="' . url('member/' . $data->id . '/show') . '" class="">' . $data->first_name . ' ' . $data->middle_name . ' ' . $data->last_name . '</a>';
        })->editColumn('age', function ($data) {
            return Carbon::now()->diffInYears(Carbon::parse($data->dob));
        })->editColumn('action', function ($data) {
            $action = '<div class="btn-group"><button type="button" class="btn btn-info btn-flat dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-list"></i></button><ul class="dropdown-menu dropdown-menu-right" role="menu">';
            if (Sentinel::hasAccess('members.view')) {
                $action .= '<li><a href="' . url('member/' . $data->id . '/show') . '" class="">' . trans_choice('general.detail', 2) . '</a></li>';
            }
            if (Sentinel::hasAccess('members.update')) {
                $action .= '<li><a href="' . url('member/' . $data->id . '/edit') . '" class="">' . trans_choice('general.edit', 2) . '</a></li>';
            }
            if (Sentinel::hasAccess('members.delete')) {
                $action .= '<li><a href="' . url('member/' . $data->id . '/delete') . '" class="delete">' . trans_choice('general.delete', 2) . '</a></li>';
            }
            $action .= "</ul></div>";
            return $action;
        })->editColumn('gender', function ($data) {
            if ($data->gender == "male") {
                return trans_choice('general.male', 1);
            }
            if ($data->gender == "female") {
                return trans_choice('general.female', 1);
            }
            if ($data->gender == "unknown") {
                return trans_choice('general.unknown', 1);
            }
        })->editColumn('photo', function ($data) {
            if (!empty($data->photo))
                return '<a href="' . asset('uploads/' . $data->photo) . '" class="fancybox"><img src="' . asset('uploads/' . $data->photo) . '" width="100"></a>';
        })->editColumn('id', function ($data) {
            return '<a href="' . url('member/' . $data->id . '/show') . '" class="">' . $data->id . '</a>';
        })->rawColumns(['id', 'name', 'action', 'photo'])->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Sentinel::hasAccess('members.create')) {
            Flash::warning("Permission Denied");
            return redirect()->back();
        }

        $branches = array();
        foreach (Branch::get() as $key) {
            $branches[$key->id] = $key->name;
        }
        $menus = array(
            'items' => array(),
            'parents' => array()
        );
        // Builds the array lists with data from the SQL result
        foreach (Tag::all() as $items) {
            // Create current menus item id into array
            $menus['items'][$items['id']] = $items;
            // Creates list of all items with children
            $menus['parents'][$items['parent_id']][] = $items['id'];
        }
        //get custom fields
        $custom_fields = CustomField::where('category', 'members')->get();

        //  ADD BY JOJO 
        $cells = Cell::all();
        $organizations = Tag::all();
        //  ADD BY JOJO 

        return view('member.create', compact('menus', 'custom_fields', 'branches', 'cells', 'organizations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!Sentinel::hasAccess('members.create')) {
            Flash::warning("Permission Denied");
            return redirect()->back();
        }
        $member = new Member();

        // $member->branch_id = $request->branch_id;
        // $member->first_name = $request->first_name;
        // $member->middle_name = $request->middle_name;
        // $member->last_name = $request->last_name;
        // $member->user_id = Sentinel::getUser()->id;
        // $member->gender = $request->gender;
        // $member->marital_status = $request->marital_status;
        // $member->status = $request->status;
        // $member->home_phone = $request->home_phone;
        // $member->mobile_phone = $request->mobile_phone;
        // $member->work_phone = $request->work_phone;

        // if (!empty($request->dob)) {
        //     $member->dob = $request->dob;
        // }

        // $member->address = $request->address;
        // $member->notes = $request->notes;
        // $member->email = $request->email;

        $member_photo = '';
        if ($request->hasFile('photo')) {
            $file = array('photo' =>  $request->file('photo'));
            $rules = array('photo' => 'required|mimes:jpeg,jpg,bmp,png');
            $validator = Validator::make($file, $rules);
            if ($validator->fails()) {
                Flash::warning(trans('general.validation_error'));
                return redirect()->back()->withInput()->withErrors($validator);
            } else {
                // $member->photo = $request->file('photo')->getClientOriginalName();
                $member_photo = $request->file('photo')->getClientOriginalName();
                $request->file('photo')->move(
                    public_path() . '/uploads',
                    $request->file('photo')->getClientOriginalName()
                );
            }
        }

        // dd($member_photo);

        $files = array();
        if ($request->hasFile('files')) {
            $count = 0;
            foreach ($request->file('files') as $key) {
                $file = array('files' => $key);
                $rules = array('files' => 'required|mimes:jpeg,jpg,bmp,png,pdf,docx,xlsx');
                $validator = Validator::make($file, $rules);
                if ($validator->fails()) {
                    Flash::warning(trans('general.validation_error'));
                    return redirect()->back()->withInput()->withErrors($validator);
                } else {
                    $files[$count] = $key->getClientOriginalName();
                    $key->move(
                        public_path() . '/uploads',
                        $key->getClientOriginalName()
                    );
                }
                $count++;
            }
        }
            // $member->files = serialize($files);
            /// ADD BY JOJO 
            // $member->cell_id = $request->cell_id;

        ;
        $member =   Member::create([
            "branch_id" => $request->branch_id,
            "first_name" => $request->first_name,
            "middle_name" => $request->middle_name,
            "last_name" => $request->last_name,
            "user_id" => Sentinel::getUser()->id,
            "gender" => $request->gender,
            "marital_status" => $request->marital_status,
            "status" => $request->status,
            "home_phone" => $request->home_phone,
            "mobile_phone" => $request->mobile_phone,
            "work_phone" => $request->work_phone,
            "dob" => $request->dob ?? '',
            "address" => $request->address,
            "notes" => $request->notes,
            "email" => $request->email,
            "files" => serialize($files),
            "cell_id" => $request->cell_id,
        ]);

        $member->photo = $member_photo;
        $member->membership_id = 'COP-' . sprintf("%'.07d\n", $member->id);
        $member->save();

        /// ADD BY JOJO 

        //check for tags
        if (!empty($request->tags)) {
            $tags = explode(',', $request->tags);
            foreach ($tags as $k) {
                $tag = new MemberTag();
                $tag->member_id = $member->id;
                $tag->tag_id = $k;
                $tag->user_id = Sentinel::getUser()->id;
                $tag->save();
            }
        }


        $custom_fields = CustomField::where('category', 'members')->get();
        foreach ($custom_fields as $key) {
            $custom_field = new CustomFieldMeta();
            $id = $key->id;
            if ($key->field_type == "checkbox") {
                if (!empty($request->$id)) {
                    $custom_field->name = serialize($request->$id);
                } else {
                    $custom_field->name = serialize([]);
                }
            } else {
                $custom_field->name = $request->$id;
            }
            $custom_field->parent_id = $member->id;
            $custom_field->custom_field_id = $key->id;
            $custom_field->category = "members";
            $custom_field->save();
        }
        GeneralHelper::audit_trail("Added member  with id:" . $member->id);
        Flash::success(trans('general.successfully_saved'));
        return redirect('member/data');
    }


    public function show($member)
    {
        if (!Sentinel::hasAccess('members.view')) {
            Flash::warning("Permission Denied");
            return redirect()->back();
        }
        $members = array();
        foreach (Member::all() as $key) {
            $members[$key->id] = $key->first_name . ' ' . $key->middle_name . ' ' . $key->last_name . '(#' . $key->id . ')';
        }
        //dd($member);
        //get custom fields
        $custom_fields = CustomFieldMeta::where('category', 'members')->where('parent_id', $member->id)->get();
        return view('member.show', compact('member', 'custom_fields', 'members'));
    }


    public function edit($member)
    {
        if (!Sentinel::hasAccess('members.update')) {
            Flash::warning("Permission Denied");
            return redirect()->back();
        }
        $menus = array(
            'items' => array(),
            'parents' => array()
        );
        $branches = array();
        foreach (Branch::get() as $key) {
            $branches[$key->id] =  $key->name;
        }
        // Builds the array lists with data from the SQL result
        foreach (Tag::all() as $items) {
            // Create current menus item id into array
            $menus['items'][$items['id']] = $items;
            // Creates list of all items with children
            $menus['parents'][$items['parent_id']][] = $items['id'];
        }
        $selected_tags = array();
        foreach (MemberTag::where('member_id', $member->id)->get() as $key) {
            array_push($selected_tags, $key->tag_id);
        }
        //get custom fields
        $custom_fields = CustomField::where('category', 'members')->get();


        //  ADD BY JOJO 
        $cells = Cell::all();
        $organizations = Tag::all();
        //  ADD BY JOJO 
        return view('member.edit', compact(
            'member',
            'selected_tags',
            'custom_fields',
            'menus',
            'branches',
            'cells',
            'organizations'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (!Sentinel::hasAccess('members.update')) {
            Flash::warning("Permission Denied");
            return redirect()->back();
        }

        $member = Member::find($id);
        $member->branch_id = $request->branch_id;
        $member->first_name = $request->first_name;
        $member->middle_name = $request->middle_name;
        $member->last_name = $request->last_name;
        $member->gender = $request->gender;
        $member->marital_status = $request->marital_status;
        $member->status = $request->status;
        $member->home_phone = $request->home_phone;
        $member->mobile_phone = $request->mobile_phone;
        $member->work_phone = $request->work_phone;
        $member->cell_id = $request->cell_id;

        if (!empty($request->dob)) {
            $member->dob = $request->dob;
        }

        $member->address = $request->address;
        $member->notes = $request->notes;
        $member->email = $request->email;
        if ($request->hasFile('photo')) {
            $file = array('photo' =>  $request->file('photo'));
            $rules = array('photo' => 'required|mimes:jpeg,jpg,bmp,png');
            $validator = Validator::make($file, $rules);
            if ($validator->fails()) {
                Flash::warning(trans('general.validation_error'));
                return redirect()->back()->withInput()->withErrors($validator);
            } else {
                $member->photo = $request->file('photo')->getClientOriginalName();
                $request->file('photo')->move(
                    public_path() . '/uploads',
                    $request->file('photo')->getClientOriginalName()
                );
            }
        }
        $files = unserialize($member->files);
        $count = count($files);
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $key) {
                $count++;
                $file = array('files' => $key);
                $rules = array('files' => 'required|mimes:jpeg,jpg,bmp,png,pdf,docx,xlsx');
                $validator = Validator::make($file, $rules);
                if ($validator->fails()) {
                    Flash::warning(trans('general.validation_error'));
                    return redirect()->back()->withInput()->withErrors($validator);
                } else {
                    $files[$count] = $key->getClientOriginalName();
                    $key->move(
                        public_path() . '/uploads',
                        $key->getClientOriginalName()
                    );
                }
            }
        }
        $member->files = serialize($files);
        $member->save();
        //check for tags
        MemberTag::where('member_id', $member->id)->delete();
        if (!empty($request->tags)) {
            $tags = explode(',', $request->tags);
            foreach ($tags as $k) {
                $tag = new MemberTag();
                $tag->member_id = $member->id;
                $tag->tag_id = $k;
                $tag->user_id = Sentinel::getUser()->id;
                $tag->save();
            }
        }
        $custom_fields = CustomField::where('category', 'members')->get();
        foreach ($custom_fields as $key) {
            if (!empty(CustomFieldMeta::where('custom_field_id', $key->id)->where('parent_id', $id)->where(
                'category',
                'members'
            )->first())) {
                $custom_field = CustomFieldMeta::where('custom_field_id', $key->id)->where(
                    'parent_id',
                    $id
                )->where('category', 'members')->first();
            } else {
                $custom_field = new CustomFieldMeta();
            }
            $kid = $key->id;
            if ($key->field_type == "checkbox") {
                if (!empty($request->$kid)) {
                    $custom_field->name = serialize($request->$kid);
                } else {
                    $custom_field->name = serialize([]);
                }
            } else {
                $custom_field->name = $request->$kid;
            }
            $custom_field->parent_id = $id;
            $custom_field->custom_field_id = $key->id;
            $custom_field->category = "members";
            $custom_field->save();
        }
        GeneralHelper::audit_trail("Updated member  with id:" . $member->id);
        Flash::success(trans('general.successfully_saved'));
        return redirect('member/data');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        if (!Sentinel::hasAccess('members.delete')) {
            Flash::warning("Permission Denied");
            return redirect()->back();
        }
        Member::destroy($id);
        MemberTag::where('member_id', $id)->delete();
        GeneralHelper::audit_trail("Deleted member  with id:" . $id);
        Flash::success(trans('general.successfully_deleted'));
        return redirect('member/data');
    }

    public function deleteFile(Request $request, $id)
    {
        if (!Sentinel::hasAccess('members.delete')) {
            Flash::warning("Permission Denied");
            return redirect()->back();
        }
        $member = Member::find($id);
        $files = unserialize($member->files);
        @unlink(public_path() . '/uploads/' . $files[$request->id]);
        $files = array_except($files, [$request->id]);
        $member->files = serialize($files);
        $member->save();
    }

    public function approve(Request $request, $id)
    {
        if (!Sentinel::hasAccess('members.approve')) {
            Flash::warning("Permission Denied");
            return redirect()->back();
        }
        $member = Member::find($id);
        $member->active = 1;
        $member->save();
        GeneralHelper::audit_trail("Approved borrower  with id:" . $member->id);
        Flash::success(trans('general.successfully_saved'));
        return redirect()->back();
    }

    public function decline(Request $request, $id)
    {
        if (!Sentinel::hasAccess('members.approve')) {
            Flash::warning("Permission Denied");
            return redirect()->back();
        }
        $member = Member::find($id);
        $member->active = 0;
        $member->save();
        GeneralHelper::audit_trail("Declined borrower  with id:" . $member->id);
        Flash::success(trans('general.successfully_saved'));
        return redirect()->back();
    }

    public function blacklist(Request $request, $id)
    {
        if (!Sentinel::hasAccess('members.blacklist')) {
            Flash::warning("Permission Denied");
            return redirect()->back();
        }
        $member = Member::find($id);
        $member->blacklisted = 1;
        $member->save();
        GeneralHelper::audit_trail("Blacklisted borrower  with id:" . $id);
        Flash::success(trans('general.successfully_saved'));
        return redirect()->back();
    }

    public function unBlacklist(Request $request, $id)
    {
        if (!Sentinel::hasAccess('members.blacklist')) {
            Flash::warning("Permission Denied");
            return redirect()->back();
        }
        $member = Member::find($id);
        $member->blacklisted = 0;
        $member->save();
        GeneralHelper::audit_trail("Undo Blacklist for borrower  with id:" . $id);
        Flash::success(trans('general.successfully_saved'));
        return redirect()->back();
    }

    public function createFamily($member)
    {
        if (!Sentinel::hasAccess('members.create')) {
            Flash::warning("Permission Denied");
            return redirect()->back();
        }
        if (!empty($member->family)) {
            Flash::warning("Family already exist");
            return redirect()->back();
        }
        $family = new Family();
        $family->user_id = Sentinel::getUser()->id;
        $family->member_id = $member->id;
        $family->name = $member->last_name;
        $family->save();
        //add family member with role of head
        $family_member = new FamilyMember();
        $family_member->user_id = Sentinel::getUser()->id;
        $family_member->member_id = $member->id;
        $family_member->family_id = $family->id;
        $family_member->family_role = "head";
        $family_member->save();
        GeneralHelper::audit_trail("Created family for member  with id:" . $member->id);
        Flash::success(trans('general.successfully_saved'));
        return redirect()->back();
    }

    public function deleteFamilyMember($id)
    {
        if (!Sentinel::hasAccess('members.update')) {
            Flash::warning("Permission Denied");
            return redirect()->back();
        }
        FamilyMember::destroy($id);
        GeneralHelper::audit_trail("Deleted family Member  with id:" . $id);
        Flash::success(trans('general.successfully_saved'));
        return redirect()->back();
    }

    public function storeFamilyMember(Request $request, $id)
    {
        if (!Sentinel::hasAccess('members.create')) {
            Flash::warning("Permission Denied");
            return redirect()->back();
        }
        if (FamilyMember::where('family_id', $id)->where('member_id', $request->member_id)->count() > 0) {
            Flash::warning("Member already in family");
            return redirect()->back();
        }

        //dd($id, Sentinel::getUser()->id);
        //add family member with role of head
        $family_member = new FamilyMember();
        $family_member->user_id = Sentinel::getUser()->id;
        $family_member->member_id = $request->member_id;
        $family_member->family_id = $id;
        $family_member->family_role = $request->family_role;
        $family_member->save();
        dd($family_member);
        GeneralHelper::audit_trail("Added family for member  with id:" . $request->member_id);
        Flash::success(trans('general.successfully_saved'));
        return redirect()->back();
    }

    public function updateFamilyMember(Request $request, $id)
    {
        if (!Sentinel::hasAccess('members.update')) {
            Flash::warning("Permission Denied");
            return redirect()->back();
        }

        //add family member with role of head
        $family_member = FamilyMember::find($id);
        $family_member->family_role = $request->family_role;
        $family_member->save();
        GeneralHelper::audit_trail("Added family for member  with id:" . $family_member->member_id);
        Flash::success(trans('general.successfully_saved'));
        return redirect()->back();
    }

    public function editFamilyMember($family_member)
    {
        if (!Sentinel::hasAccess('members.update')) {
            Flash::warning("Permission Denied");
            return redirect()->back();
        }

        return View::make('member.edit_family_member', compact('family_member'))->render();
    }

 

    public function pdfStatement($member)
    {
        // Check for permission to view members
        if (!Sentinel::hasAccess('members.view')) {
            Flash::warning("Permission Denied");
            return redirect()->back();
        }
    
        // Generate the PDF content from the Blade view
        $pdf = PDF::loadView('member.pdf_member_statement', compact('member'))
                  ->setPaper('a4')               // Set the paper size, if needed
                  ->setOption('author', 'Tererai Mugova'); // Set the author
    
        // Output the PDF as a download
        return $pdf->download($member->first_name . ' ' . $member->last_name . " - Statement.pdf");
    }

    public function printStatement($member)
    {
        if (!Sentinel::hasAccess('members.view')) {
            Flash::warning("Permission Denied");
            return redirect()->back();
        }

        return View::make('member.print_member_statement', compact('member'))->render();
    }

    // public function emailStatement($member)
    // {
    //     // Check for permission to view members
    //     if (!Sentinel::hasAccess('members.view')) {
    //         Flash::warning("Permission Denied");
    //         return redirect()->back();
    //     }
    
    //     if (empty($member->email)) {
    //         Flash::warning("Member has no email set");
    //         return redirect('member/' . $member->id . '/show');
    //     }
    
    //     // Prepare the email body
    //     $template = Setting::where('setting_key', 'member_statement_email_template')->first();
    //     $body = $template ? $template->setting_value : '';
    //     $placeholders = [
    //         '{firstName}' => $member->first_name,
    //         '{middleName}' => $member->middle_name,
    //         '{lastName}' => $member->last_name,
    //         '{address}' => $member->address,
    //         '{homePhone}' => $member->home_phone,
    //         '{mobilePhone}' => $member->mobile_phone_phone,
    //         '{email}' => $member->email,
    //         '{totalContributions}' => GeneralHelper::member_total_contributions($member->id),
    //         '{totalPledges}' => round(GeneralHelper::member_total_pledges($member->id), 2),
    //         '{total}' => round(
    //             GeneralHelper::member_total_contributions($member->id) + GeneralHelper::member_total_pledges($member->id),
    //             2
    //         ),
    //     ];
    
    //     foreach ($placeholders as $key => $value) {
    //         $body = str_replace($key, $value, $body);
    //     }
    
    //     // Generate the PDF and save it temporarily
    //     $pdfPath = public_path('uploads/temporary/member_statement' . $member->id . '.pdf');
    //     PDF::loadView('member.pdf_member_statement', compact('member'))
    //         ->setPaper('a4')
    //         ->setOption('author', 'Tererai Mugova')
    //         ->save($pdfPath);
    
    //     // Ensure the PDF file was created successfully
    //     if (!file_exists($pdfPath)) {
    //         Flash::error("Failed to generate the PDF statement.");
    //         return redirect('member/' . $member->id . '/show');
    //     }
    
    //     $file_name = $member->first_name . ' ' . $member->last_name . " - Member Statement.pdf";
    
    //     // Send the email with the PDF attached
    //     Mail::send([], [], function ($message) use ($member, $file_name, $body, $pdfPath) {
    //         $company_email = Setting::where('setting_key', 'company_email')->first()->setting_value;
    //         $company_name = Setting::where('setting_key', 'company_name')->first()->setting_value;
    
    //         $message->from($company_email, $company_name)
    //                 ->to($member->email)
    //                 ->subject(Setting::where('setting_key', 'member_statement_email_subject')->first()->setting_value)
    //                 ->setBody($body, 'text/html')
    //                 ->attachFromPath($pdfPath, $file_name); // Use attachFromPath
    //     });
    
    //     // Remove the temporary file after sending the email
    //     if (file_exists($pdfPath)) {
    //         unlink($pdfPath);
    //     }
    
    //     // Log the email in the database
    //     Email::create([
    //         'user_id' => Sentinel::getUser()->id,
    //         'message' => $body,
    //         'subject' => Setting::where('setting_key', 'member_statement_email_subject')->first()->setting_value,
    //         'recipients' => 1,
    //         'send_to' => $member->first_name . ' ' . $member->last_name . ' (' . $member->id . ')',
    //     ]);
    
    //     Flash::success("Statement successfully sent");
    //     return redirect('member/' . $member->id . '/show');
    // }
    
    public function emailStatement($member)
{
    // Check for permission to view members
    if (!Sentinel::hasAccess('members.view')) {
        Flash::warning("Permission Denied");
        return redirect()->back();
    }

    if (empty($member->email)) {
        Flash::warning("Member has no email set");
        return redirect('member/' . $member->id . '/show');
    }

    // Prepare the email body
    $template = Setting::where('setting_key', 'member_statement_email_template')->first();
    $body = $template ? $template->setting_value : '';
    $placeholders = [
        '{firstName}' => $member->first_name,
        '{middleName}' => $member->middle_name,
        '{lastName}' => $member->last_name,
        '{address}' => $member->address,
        '{homePhone}' => $member->home_phone,
        '{mobilePhone}' => $member->mobile_phone_phone,
        '{email}' => $member->email,
        '{totalContributions}' => GeneralHelper::member_total_contributions($member->id),
        '{totalPledges}' => round(GeneralHelper::member_total_pledges($member->id), 2),
        '{total}' => round(
            GeneralHelper::member_total_contributions($member->id) + GeneralHelper::member_total_pledges($member->id),
            2
        ),
    ];

    foreach ($placeholders as $key => $value) {
        $body = str_replace($key, $value, $body);
    }

    // Generate the PDF and save it temporarily
    $pdfPath = public_path('uploads/temporary/member_statement' . $member->id . '.pdf');
    PDF::loadView('member.pdf_member_statement', compact('member'))
        ->setPaper('a4')
        ->setOption('author', 'Tererai Mugova')
        ->save($pdfPath);

    // Ensure the PDF file was created successfully
    if (!file_exists($pdfPath)) {
        Flash::error("Failed to generate the PDF statement.");
        return redirect('member/' . $member->id . '/show');
    }

    $file_name = $member->first_name . ' ' . $member->last_name . " - Member Statement.pdf";

    // Send the email with the PDF attached
    Mail::send([], [], function ($message) use ($member, $file_name, $body, $pdfPath) {
        $company_email = Setting::where('setting_key', 'company_email')->first()->setting_value;
        $company_name = Setting::where('setting_key', 'company_name')->first()->setting_value;

        $message->from($company_email, $company_name)
                ->to($member->email)
                ->subject(Setting::where('setting_key', 'member_statement_email_subject')->first()->setting_value)
                ->setBody($body, 'text/html')
                ->attach($pdfPath, [
                    'as' => $file_name,
                    'mime' => 'application/pdf',
                ]);
    });

    // Remove the temporary file after sending the email
    if (file_exists($pdfPath)) {
        unlink($pdfPath);
    }

    // Log the email in the database
    Email::create([
        'user_id' => Sentinel::getUser()->id,
        'message' => $body,
        'subject' => Setting::where('setting_key', 'member_statement_email_subject')->first()->setting_value,
        'recipients' => 1,
        'send_to' => $member->first_name . ' ' . $member->last_name . ' (' . $member->id . ')',
    ]);

    Flash::success("Statement successfully sent");
    return redirect('member/' . $member->id . '/show');
}

    
}
