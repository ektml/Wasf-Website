<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Offer;
use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Photo;
use App\Models\Product;
use App\Models\Discount;
use App\Models\CardOrder;
use App\Models\Payment;
use App\Models\Requests;
use Illuminate\Http\Request;
use App\Http\Services\PayTabs;
use App\Http\Controllers\Api\CartController;
use App\Notifications\requests\AcceptOffer;
use Illuminate\Support\Facades\Notification;
use App\Http\Controllers\Api\ApiResponseTrait;
use App\Http\Controllers\payment\HayperpayController;


class PaymentController extends Controller
{
    use ApiResponseTrait;

    // HyperPay
    public static function checkout($price)
    {
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
        return json_decode($responseData,'true') ;
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
        return json_decode($responseData, true);
    }

    // End HyperPay




    //for request only
    function walletpay( Request $request)
    {
        $offer_id=$request->offer;
        $request_id=$request->request_id;
        $offer_price= Offer::where('id',$offer_id)->first()->price;
        $freelancer_id= Offer::where('id',$offer_id)->first()->freelancer_id;

        if($this->getuserwallet()>=$offer_price){
            $total_wallet_after_pay=$this->getuserwallet()-$offer_price;
            $edit_offer= Requests::findorfail($request_id)->offer()->where('id',$offer_id)->update([
                "status"=>'active',
            ]);

            $edit_other_offer=Requests::findorfail($request_id)->offer()->where('id',"!=",$offer_id)->update([
                "status"=>'reject',
            ]);

            $edit_request=Requests::findorfail($request_id)->update([
                'freelancer_id'=>$freelancer_id,
                'status'=>"In Process"
            ]);

            $edit_pay =Requests::findorfail($request_id)->payment()->create([
                'user_id'=>auth()->user()->id,
                'freelancer_id'=>$freelancer_id,
                "status"=>'purchase',
                "pay_type"=>'wallet',
                "total"=>$offer_price,
            ]);

            $edit_wallet=User::findOrFail(auth()->user()->id)->wallet()->update([
                "total" => $total_wallet_after_pay
            ]);

        if( $edit_offer && $edit_request && $edit_pay &&$edit_wallet ){
            $freelancer = User::find($freelancer_id);
            $user_create = auth()->user()->id;
            $request=Requests::find($request_id);
            Notification::send($freelancer, new AcceptOffer($user_create,$request_id, 'request', $request->random_id));
            return redirect()->back()->with(["message" => 'paydone']);
        }else{
            return redirect()->back()->with(["message" => "payfail",'content'=>'some thing went wrong']);
        }
        }else{
            return redirect()->back()->with(["message" => "payfail",'content'=>'money not enough']);
        }
    }

//for request only
    static function bankpay($request_id,$offer_id)
    {
        $offer_id = request()->offer_id;
        $request_id = request()->request_id;
        $offer_price = Offer::where('id',$offer_id)->first()->price;
        $freelancer_id = Offer::where('id',$offer_id)->first()->freelancer_id;
        $edit_offer = null;
        $edit_request = null;
        $edit_pay = null;

        if (request('id') && request('resourcePath'))
        {
            $Hp = new HayperpayController();
            $payment_status = $Hp->getPaymentStatus(request('id'), request('resourcePath'));
        if(isset($payment_status['id']))
        {
            $visa_pay_id=$payment_status['id'];
            $edit_offer = Requests::findorfail($request_id)->offer()->where('id',$offer_id)->update([
                "status"=>'active',
            ]);

            $edit_other_offer = Requests::findorfail($request_id)->offer()->where('id',"!=",$offer_id)->update([
                "status"=>'reject',
            ]);

            $edit_request = Requests::findorfail($request_id)->update([
                'freelancer_id'=>$freelancer_id,
                'status'=>"In Process"
            ]);

            $edit_pay = Requests::findorfail($request_id)->payment()->create([
                'user_id'=>auth()->user()->id,
                'freelancer_id' => $freelancer_id,
                "status" => 'pending',
                "pay_type" => 'bank',
                "total" => $offer_price,
                "visapay_id" => $visa_pay_id
            ]);
        }
    }
        if($edit_offer && $edit_request && $edit_pay)
        {
            $freelancer = User::find($freelancer_id);
            $user_create = auth()->user()->id;
            $request = Requests::find($request_id);
            Notification::send($freelancer, new AcceptOffer($user_create,$request_id, 'request', $request->random_id));
            return redirect()->back()->with(["state"=>'paydone']);
        }else{
            toastr()->error('some thing went wrong');
            return redirect()->back();
        }
    }




    static function walletpay2($total)
    {
        if(SELF::getuserwallet()>=$total){
            $total_wallet_after_pay = SELF::getuserwallet() - $total;
            $edit_wallet = User::findOrFail(auth()->user()->id)->wallet()->update([
                "total" => $total_wallet_after_pay,
            ]);
            return true;
        }
        return false;
    }

    static function getuserwallet()
    {
        return User::findOrFail(auth()->user()->id)->wallet->total;
    }
    
    
    
    
    
    
    public function  cartBankPay(Request $request,$user_id, $discount_key =null){
        
        try{
         $paydata=[];
    $payed=false;
    $discount=null;
    $discount_id=null;
    $visa_pay_id=null;
    $disvalue=0;
    $payment_fail=false;


   
    
                if ($request->id && $request->status =='paid') {
             
                    $paymentService = new \Moyasar\Providers\PaymentService();
                    $payment = $paymentService->fetch($request->id);
                    
                    //culc discount and get  price
                    if(Discount::where('key',$discount_key)->exists()){
                    $discount=Discount::where('key',$discount_key)->first();
                    $discount_id=$discount->id;
                    $disvalue=$discount->value.$discount->by;
                   }
                  $cartController=  new CartController;
                    $paydata= $cartController->calcCartTotal($user_id,$discount);
                    if(trim($payment->amountFormat,config('moyasar.currency'))!=$paydata['total']){
                        
                        $payment_fail=true;
                    }

    
            }elseif(request('status')=='failed'){
                $payment_fail=true;
                
            }
            else{
                $payment_fail=true;
            }
            
            
            if(!$payment_fail && Cart::where('user_id',$user_id)->exists()  ){
                
                       $order= CardOrder::create([
                       'user_id'=>$user_id,
                       'price'=>$paydata['price'],
                       'discount_id'=> $discount_id,
                       'total'=>$paydata['total'],
                        ]);
                    foreach($paydata['cartadditems'] as $data ){
                       $item =$data->cartsable;
                      $item->sells()->create([
                       "user_id"=>$user_id,
                       "type"=>$data->type,
                       'price'=>$data->price,
                       'card_order_id'=>$order->id
                        ]);
                
                       $tot= User::findOrFail($item->freelancer_id)->wallet->total ;
                       $tot+= $data->price;
                        User::findOrfail($item->freelancer_id)->wallet()->update([
                            "total"=> $tot,
                           ]);
                      
                     }
                
                     $order->payment()->create([
                        'user_id'=>$user_id,
                        'pay_type'=>'bank',
                        "status"=>'purchase',
                        'total'=>$paydata['total'],
                        'discount'=>$disvalue,
                        'visapay_id'=>$visa_pay_id,
                
                    ]);
                
                // update payment description in moyasar
                 $payment->update('order is '.$order->id);
                 
                
                //  empty cart 
                Cart::where('user_id',$user_id)->delete();
                
                return $this->returnData(201, 'pay done  Successfully');
                
            }else{
                
                return $this->returnError(400,'some thing went wrong');
                
            }
            
            
        
        
    }catch(\Exception $e){
        
        echo $e;
        
        return $this->returnError(400,'some thing went wrong');
    }

}


public function checkCartPay($total){
    
    try{
        
    
   $date = Carbon::now(auth('api')->user()->timezone)->toDateString();
   $hour = Carbon::now()->hour;

// Query the payments table for payments made today by the authenticated user
$payments = Payment::where('user_id',auth('api')->user()->id)
                   ->whereDate('created_at', $date)->where('total',$total) ->latest()
                  ->first();
                        
                   if($payments!=null){
                      return $this->returnData(201, 'pay done  Successfully');  
                   }else{
                        return $this->returnError(400,'some thing went wrong');
                   }
   
    }catch(\Exception $e){
        echo $e;
        
      return $this->returnError(400,'some thing went wrong');
    }           
}
   

}
