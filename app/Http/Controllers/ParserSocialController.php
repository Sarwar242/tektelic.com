<?php

namespace App\Http\Controllers;

use App\Exceptions\SocialParser\ParserRun;
use App\Helpers\ApiRequests;
use App\Helpers\LinkedInHelper;
use App\Helpers\TwitterHelper;
use App\Models\Articles;
use Illuminate\Http\Request;
use Thujohn\Twitter\Facades\Twitter;


/**
 * Class ParserSocialControlelr
 * @package App\Http\Controllers
 */
class ParserSocialController extends Controller
{
    public function index()
    {
        $social = new ParserRun();
        $data = $social->run();
        dd($data);
    }

    public function linkedin()
    {
        $social = new ParserRun();

        $client_id = LinkedInHelper::CLIENT_ID;
        $client_secret = LinkedInHelper::CLIENT_SECRET;

        $data = [];

        /* $url = "https://www.linkedin.com/oauth/v2/authorization?response_type=code&client_id={$client_id}&redirect_uri=http%3A%2F%2Ftaktelic.loc%2Flinkedin-redirect&state=fooobar&scope=r_liteprofile%20r_emailaddress";

             $res = ApiRequests::sendRequest($url, 'GET', $data);
             dd($res);*/

        LinkedInHelper::getAccessToken();

        //$data = $social->runLinkedin();
        //dd($data);
    }

    public function linkedinRedirect()
    {
        $token = LinkedInHelper::getAccessToken();
        // var_dump($token);
        var_dump(session('linkedin_access_token'));

        $data = [];

        $url = "https://api.linkedin.com/v2/ugcPosts?q=authors&authors=List(https%3A%2F%2Fwww.linkedin.com%2Fcompany%2F69490388%2Fadmin%2F)";
        $res = ApiRequests::sendRequest($url, 'GET', $data, $token);

    }

    public function twitter()
    {
        $posts = Twitter::getUserTimeline(['screen_name' => 'JaneM06340479', 'count' => 20, 'format' => 'json']);

        $posts = json_decode($posts,true);

        foreach($posts as $post){
            if(!empty($post['entities']['media'][0]['media_url'])) {
                $image_link = $post['entities']['media'][0]['media_url'];
            }
            else{
                $image_link=null;
            }

            $title=$post['text'];

            $originalDate = $post['created_at'];
            $newDate = date("Y-m-d H:i:s", strtotime($originalDate));

            TwitterHelper::saveApiArticles($post['text'],$image_link,$post['id'],$newDate,$title);
        }

    }
}
