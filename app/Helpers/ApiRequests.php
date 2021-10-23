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

class ApiRequests
{
    public static function sendRequest($url, $method, $data = null,$security_token=0)
    {

        if($security_token!=0) {
            $st = "Bearer: $security_token";
        }
        else{
            $st='';
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,"$url");

        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "$method");
        if($method=="POST") {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        }

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                $st,
            )
        );

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $server_output = curl_exec($ch);

        echo "<pre>";
        var_dump($server_output);
        echo "</pre>";
        die;

        return json_decode($server_output,true);
    }

}
