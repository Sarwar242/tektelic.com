<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Contact;
use App\Models\PageLang;
use App\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AboutUsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {

        $lang = Helper::ENG;

        $page =  PageLang::where(
            'lang', '=', $lang
        )->where('slug', '=', PageLang::ABOUT_US_SLUG)->with(['page' => function ($query) {
            $query->where('status',  Helper::PUBLISHED);
        }])->first();

        $contacts = Contact::where('status', Helper::PUBLISHED)->get();

        return view('about-us.index',['page'=>$page,'contacts'=>$contacts]);
    }



   /* public function sendEmail(Request $request)
    {

        $to_name = 'Name';
        $to_email = "medovaya.zhenya@gmail.com";
        $data = array('request'=>$request);

        try {
            Mail::send('emails.mail', $data, function ($message) use ($to_name, $to_email) {
                $message->to($to_email, $to_name)
                    ->subject('Message from site');
                $message->from('hello@nextdoorcoders.com', 'Message');
            });

        }catch(\Exception $e) {
            return redirect()->back()->with('success', 'Error');
           // echo $e->getMessage();
        }

        return redirect()->back()->with('success', 'Email is sent');

    }*/


}
