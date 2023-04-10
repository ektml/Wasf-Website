<?php

namespace App\Http\Controllers\payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HayperpayController extends Controller
{
    public static function checkout($price){
        
            $url = config('hayperpay.hyperpay.url');
            $data = "entityId=".config('hayperpay.hyperpay.entity_id').
                        "&amount=".$price.
                        "&currency=" .config('hayperpay.hyperpay.currency').
                        "&paymentType=DB";
        
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                           'Authorization:Bearer '.config('hayperpay.hyperpay.auth_key')));
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, config('hayperpay.hyperpay.production'));// this should be set to true in production
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $responseData = curl_exec($ch);
            if(curl_errno($ch)) {
                return curl_error($ch);
            }
            curl_close($ch);
       	return  json_decode($responseData,'true') ;


        
    }


    public static function getPaymentStatus($id,$resourcepath)
    {
        $url = config('hayperpay.hyperpay.url').'/';
        $url .= ltrim($resourcepath,'v1/checkouts/');
        $url .= "?entityId=".config('hayperpay.hyperpay.entity_id');

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization:Bearer ' . config('hayperpay.hyperpay.auth_key')));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, config('hayperpay.hyperpay.production'));// this should be set to true in production
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $responseData = curl_exec($ch);
        if (curl_errno($ch)) {
            return curl_error($ch);
        }
        curl_close($ch);
        // dd(json_decode($responseData, true));
        return json_decode($responseData, true);

    }
}
