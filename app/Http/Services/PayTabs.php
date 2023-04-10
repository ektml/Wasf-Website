<?php
namespace App\Http\Services;
use Paytabscom\Laravel_paytabs\Facades\paypage;

class  PayTabs{

// $pay = paypage::sendPaymentCode($payment_method)//all or visa
// ->sendTransaction($transaction_type) //sales  ,refund ,
// ->sendCart($cart_id, $cart_amount, $cart_description)
// ->sendCustomerDetails($name, $email, $phone, $street1, $city, $state, $country, $zip, $ip)->sendShippingDetails($same_as_billing, $name = null, $email = null, $phone = null, $street1= null, $city = null, $state = null, $country = null, $zip = null, $ip = null)
// ->sendHideShipping($on = false)
// ->sendURLs($return, $callback)
// ->sendLanguage($language)
// ->sendFramed($on = false)
// ->create_pay_page(); 

static function pay(){
    function request() {
        $url = "https://eu-test.oppwa.com/v1/payments";
        $data = "entityId=8a8294174b7ecb28014b9699220015ca" .
                    "&amount=92.00" .
                    "&currency=EUR" .
                    "&paymentBrand=VISA" .
                    "&paymentType=DB" .
                    "&card.number=4200000000000000" .
                    "&card.holder=Jane Jones" .
                    "&card.expiryMonth=05" .
                    "&card.expiryYear=2034" .
                    "&card.cvv=123";
    
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                       'Authorization:Bearer OGE4Mjk0MTc0YjdlY2IyODAxNGI5Njk5MjIwMDE1Y2N8c3k2S0pzVDg='));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $responseData = curl_exec($ch);
        if(curl_errno($ch)) {
            return curl_error($ch);
        }
        curl_close($ch);
        dd($responseData);
    }
    $responseData = request();
    dd($responseData);
}

} 


