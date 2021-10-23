<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use Illuminate\Http\Request;

/**
 * Class SiteController
 * @package App\Http\Controllers
 */
class MinisiteController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('mini.site.index');
    }

    public function edoctor()
    {
        return view('mini.edoctor.index');
    }

    public function getInTouch()
    {
        $data = [];
        parse_str($_POST['data'], $data);
        $mess='';
        $db_request = new \App\Models\Request();
        $db_request->country_id=$data['country_id'];
        $db_request->email=$data['email'];
        $db_request->type='get-in-touch';
        $db_request->manager_email=Helper::MANAGER_EMAIL;
        $db_request->save();

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
    }

    public function contactUs()
    {
        $data = [];
        parse_str($_POST['data'], $data);
        $mess='';

        $db_request = new \App\Models\Request();
        $db_request->country_id=$data['country_id']??0;
        $db_request->body=$data['mess']??'';
        $db_request->name=$data['name']??'';
        $db_request->lastname = $data['lastname']??'';
        $db_request->company = $data['company']??'';
        $db_request->message = $data['text']??'';
        $db_request->type=$data['type'];
        $db_request->email=$data['email']??'';
        $db_request->linkedin=$data['phone_or_linkedin']??'';
        $db_request->phone=$data['phone']??'';
        $db_request->manager_email=Helper::MANAGER_EMAIL;
        $db_request->save();

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
    }
}
