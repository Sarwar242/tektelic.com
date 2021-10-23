<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Contact;
use App\Models\PageLang;
use App\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{

    public function sendEmail($request,$path='emails.mail')
    {

        $to_name = 'Name';
        $to_email = Helper::MANAGER_EMAIL;
        $to_email2 = Helper::MANAGER_EMAIL2;
        $to_email3 = Helper::MANAGER_EMAIL3;
        $to_email4 = Helper::MANAGER_EMAIL4;

        $emails = [$to_email2,$to_email3,$to_email4];

        $subject = \App\Models\StaticTextLang::t("Website contact forms submissions",'footer_form');
        $data = array('request'=>$request);

        foreach ($emails as $email) {
            Mail::send($path, $data, function ($message) use ($to_name, $email, $subject) {
                $message->to($email, $to_name)
                    ->subject($subject);
                $message->from(Helper::SENDER, '');
            });
           /* Mail::send($path, $data, function ($message) use ($to_name, $to_email2, $subject) {
                $message->to($to_email2, $to_name)
                    ->subject($subject);
                $message->from(Helper::SENDER, '');
            });*/
        }

    }

    public function aboutUsEmail(Request $request)
    {
        $db_request=\App\Models\Request::saveRequest($request);
        try {
           // $this->sendEmail($db_request);
        }
        catch(\Exception $e) {
                return redirect()->back()->with('success', $e->getMessage());
                // echo $e->getMessage();
            }

        return redirect()->back()->with('success', 'Email is sent');

    }

    public function addRequest()
    {
        $data = [];
        parse_str($_POST['data'], $data);


        $db_request=\App\Models\Request::saveRequest($data);

       /* $db_request = new \App\Models\Request();
        $db_request->country_id=$data['country_id'];
        $db_request->body=$data['mess'];
        $db_request->name=$data['name'];
        $db_request->type=$data['type'];
        $db_request->email=$data['email'];
        $db_request->linkedin=$data['linkedin'];
        $db_request->phone=$data['phone_or_linkedin'];
        $db_request->manager_email=Helper::MANAGER_EMAIL;
        $db_request->save();*/

        $mess='';
        try {
           // $this->sendEmail($db_request,'emails.request');
           // $mess = 'You successfully subscribed';
            $mess = 'Thank you for contacting TEKTELIC. We will contact you at the nearest time';//'Thank you. We will contact you in the nearest hour.';
        }
        catch(\Exception $e) {
           // return redirect()->back()->with('success', 'Error');
            // echo $e->getMessage();
            $mess = 'error';
        }

        return response()->json([
            'mess' => $mess,
        ]);
        //return redirect()->back()->with('success', 'Email is sent');

    }

    public function contactUs()
    {
        $data = [];
        parse_str($_POST['data'], $data);
        $mess='';
        $db_request=\App\Models\Request::saveRequest($data);
        try {
           // $this->sendEmail($db_request,'emails.contact_us');
            $mess = 'Your request has been successfully submitted. We will contact you at the nearest time. Thank you!';//'Your email is sent';
        }
        catch(\Exception $e) {
            // return redirect()->back()->with('success', 'Error');
             echo $e->getMessage();
            $mess = 'error';
        }

        return response()->json([
            'mess' => $mess,
        ]);
        //return redirect()->back()->with('success', 'Email is sent');

    }


}
