<?php

namespace App\Helpers;


use App\Comparison;
use App\Models\BenefitLang;
use App\Models\Category;
use App\Models\CountryLang;
use App\Models\EntityType;
use App\Models\KeyAres;
use App\Models\KeysAreaLang;
use App\Models\QualityLifesLang;
use App\Models\Technology;
use App\Models\TechnologyLang;
use App\Models\UseCaseLang;
use App\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;

class LinkedInHelper
{
    const CLIENT_ID='77wk7bww2feyc0';
    const CLIENT_SECRET='cuFsjLmVHEYgsJP7';

    public static function getAccessToken()
    {
       // session_start();
        $return_token = null;

        if (empty(session('linkedin_access_token'))) {
            $provider = new \League\OAuth2\Client\Provider\LinkedIn([
                'clientId' => LinkedInHelper::CLIENT_ID,
                'clientSecret' => LinkedInHelper::CLIENT_SECRET,
                'redirectUri' => 'http://taktelic.loc/linkedin-redirect',
            ]);

            if (!isset($_GET['code'])) {

                // If we don't have an authorization code then get one
                $authUrl = $provider->getAuthorizationUrl();
                $_SESSION['oauth2state'] = $provider->getState();
                header('Location: ' . $authUrl);
                exit;

// Check given state against previously stored one to mitigate CSRF attack
            } elseif (empty($_GET['state']) || (!empty(session('oauth2state')) && $_GET['state'] !== session('oauth2state'))) {

                unset($_SESSION['oauth2state']);
                exit('Invalid state');

            } else {

                // Try to get an access token (using the authorization code grant)
                $token = $provider->getAccessToken('authorization_code', [
                    'code' => $_GET['code']
                ]);

                // Optional: Now you have a token you can look up a users profile data
                /* try {

                     // We got an access token, let's now get the user's details
                     $user = $provider->getResourceOwner($token);

                     // Use these details to create a new profile
                     printf('Hello %s!', $user->getFirstName());

                 } catch (\Exception $e) {

                     // Failed to get user details
                     exit('Oh dear...');
                 }*/

                // Use this to interact with an API on the users behalf
                //echo $token->getToken();
                $return_token = $token->getToken();
                session(['linkedin_access_token' => $return_token]);
                //$_SESSION['linkedin_access_token'] = $return_token;

            }
        }
        else{
            $return_token = session('linkedin_access_token');
        }

      //  var_dump($return_token);
        //var_dump(session('linkedin_access_token'));

        return session('linkedin_access_token');
    }



}

