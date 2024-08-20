<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Carbon;

use App\Models\User;
use App\Models\Member;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;

class NotificationsCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Notifications:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Notifications automatique ';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        //$logText = "";
        $members = Member::All();
        foreach ($members as $key => $member) {
            //Check birthday of member
            if (!is_null($member->dob) &&  Carbon::parse($member->dob)->isBirthday()) {
                Log::info("\n cron Notifications executé $member->dob  $member->first_name   $member->last_name  happy birthday");

                // SEND EMAIL 
                /***
                 * Check if the member have email adresse 
                 * if yes send email if not , email will not send
                 */

                if (!empty($member->email)) {

                    //** SENDING NOTIFICATIONS EMAIL */
                    $appDomaine = str_replace("http:", "", env('APP_URL'));
                    $appDomaine = str_replace("/", "", $appDomaine);
                    $appDomaine = str_replace("https:", "", $appDomaine);
                    $appDomaine = str_replace("/", "", $appDomaine);

                    $mail =  Mail::send('emails.notifications_email_template', array(

                        'mail_type' => "happy_birthday",
                        'first_name' => $member->first_name,
                        'last_name' => $member->last_name,
                        'the_message' => "Hope you have a warm day, we are thinking of you always, and I'll see you soon!",

                        'email' => $member->email,
                    ), function ($message) use ($member, $appDomaine) {
                        $message->from('no-reply@' . $appDomaine, env('APP_NAME'));
                        $message->to($member->email, "$member->first_name $member->last_name")
                            ->subject("happy birthday :: " . env('APP_NAME'));
                    });

                    if ($mail) {
                        Log::info(" \n 'Sorry! Please try again latter'");
                        //return response()->Fail('Sorry! Please try again latter');
                    } else {
                        Log::info(" \n 'Great! Successfully send in your mail'");
                        //return response()->success('Great! Successfully send in your mail');
                    }


                    // SEND EMAIL 
                    /***
                     * Check if the member have email adresse 
                     * if yes send email if not , email will not send
                     */

                    if (!empty($member->mobile_phone)) {

                        $response = Http::post('http://rslr.connectbind.com:8080/bulksms/bulksms', [
                            'username' => 'msgh-test',
                            'password' => 'As#23ghn',
                            'type' => '0',
                            'dlr' =>  '1',
                            'destination' => $member->mobile_phone,
                            'source' => env('APP_NAME'),
                            'message' => "$member->first_name $member->last_name Happy birthday  Hope you have a warm day, we are thinking of you always, and I'll see you soon!"

                        ]);
                    }
                } else {
                }

                //return "happy birthday";
            }
        }

        // Log::info("\n cron tontine executé");
    }
}
