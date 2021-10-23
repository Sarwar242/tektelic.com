<?php


namespace App\Exceptions;


class Helpers
{
    public function __construct()
    {

    }

    /**
     * @param $url
     * @param array $params
     */
    public function request($url,$params = [])
    {

    }

    public function generateToken($param = [])
    {
        $result = null;
        if(!empty($param)) {
            if($param['social'] = 'fb') {
//                $result = file_get_contents('https://graph.facebook.com/oauth/access_token?client_id='.$param['client_id'].'&client_secret='.$param['client_secret'].'&grant_type=client_credentials');
                $result = file_get_contents(
                    'https://graph.facebook.com/oauth/access_token?grant_type=fb_exchange_token&
                      client_id='.$param['client_id'].'
                      client_secret='.$param['client_secret'].'&
                      fb_exchange_token={short-lived-user-access-token}'
                );
                dd($result);
                return json_decode($result)->access_token;
            }
        }
        return $result;
    }
}
