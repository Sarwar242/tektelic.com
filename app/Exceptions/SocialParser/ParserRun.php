<?php


namespace App\Exceptions\SocialParser;


use App\Exceptions\Helpers;
use Facebook\Exceptions\FacebookSDKException;

class ParserRun
{
    public function __construct($params = [])
    {

    }

    /**
     * @throws FacebookSDKException
     */
    public function run()
    {
        $token = (new Helpers())->generateToken(['social'=>'fb','client_id'=>'736546576717853','client_secret'=>'fad85a9eedef641bdc262e8477744912']);
        $fb = new \Facebook\Facebook([
            'app_id' => '736546576717853',
            'app_secret' => 'fad85a9eedef641bdc262e8477744912',
            'default_graph_version' => 'v2.10',
            'default_access_token' => $token
        ]);
        $request = $fb->get( '/me');
        try {
            $object = $request->getGraphNode();
            dd($object);
//            $response->get('569725246816096/feed',$token);
        } catch (FacebookSDKException $e) {

        }

    }

    public function runLinkedin()
    {

    }
}
