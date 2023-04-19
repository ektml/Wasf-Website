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

   


    //for request only
    function requestWalletPay( Request $request ,$user_id)
    {
        try{
        $offer_id=$request->offer;
        $request_id=$request->request_id;

      

        $offer_price= Offer::where('id',$offer_id)->first()->price;
        $freelancer_id= Offer::where('id',$offer_id)->first()->freelancer_id;

        if($this->getuserwallet($user_id)>=$offer_price ){
            $total_wallet_after_pay=$this->getuserwallet($user_id)-$offer_price;
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
                'user_id'=>$user_id,
                'freelancer_id'=>$freelancer_id,
                "status"=>'purchase',
                "pay_type"=>'wallet',
                "total"=>$offer_price,
            ]);

            $edit_wallet=User::findOrFail($user_id)->wallet()->update([
                "total" => $total_wallet_after_pay
            ]);

        if( $edit_offer && $edit_request && $edit_pay &&$edit_wallet ){
            $freelancer = User::find($freelancer_id);
            $user_create = $user_id;
            $request=Requests::find($request_id);
            Notification::send($freelancer, new AcceptOffer($user_create,$request_id, 'request', $request->random_id));
            return $this->returnData(201, 'pay done  Successfully');
        }else{
            return $this->returnError(400,'some thing went wrong');
        }
        }else{
            return $this->returnError(400,'some thing went wrong');
        }


    }catch(\Exception $e){
        echo $e;
        return $this->returnError(400,'some thing went wrong');
    }
    }



    public function requestBankPay($id,$request_id,$offer_id){
      try{

        $offer_price= Offer::where('id',$offer_id)->first()->price;
        $freelancer_id= Offer::where('id',$offer_id)->first()->freelancer_id;
        $edit_offer =null;
       $edit_request =null;
       $edit_pay =null;
        
        
        if (request()->id && request()->status=='paid') {
            $paymentService = new \Moyasar\Providers\PaymentService();
            $payment = $paymentService->fetch(request()->id);
       
           
       if(true){
        
        $visa_pay_id=$payment->id;
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
          'user_id'=>$id,
          'freelancer_id'=>$freelancer_id,
          "status"=>'pending',
          "pay_type"=>'bank',
          "total"=>$offer_price,
          "visapay_id"=> $visa_pay_id
         ]);
       }
      
    }

    
    if( $edit_offer && $edit_request && $edit_pay ){
        $freelancer = User::find($freelancer_id);
        $user_create = $id;
        $request=Requests::find($request_id);
        Notification::send($freelancer, new AcceptOffer($user_create,$request_id, 'request', $request->random_id));
        return $this->returnData(201, 'pay done  Successfully');
    }else{
        return $this->returnError(400,'some thing went wrong');
    }
    
            }catch(\Exception $e){
                echo $e;
                return $this->returnError(400,'some thing went wrong');
            }

    }



   



    static function walletpay2($total)
    {
        if(SELF::getuserwallet()>=$total){
            $total_wallet_after_pay = SELF::getuserwallet() - $total;
            $edit_wallet = User::findOrFail(auth('api')->user()->id)->wallet()->update([
                "total" => $total_wallet_after_pay,
            ]);
            return true;
        }
        return false;
    }

    static function getuserwallet($user_id)
    {
        return User::findOrFail($user_id)->wallet->total;
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
                    // if(trim($payment->amountFormat,config('moyasar.currency'))!=$paydata['total']){
                        
                    //     $payment_fail=true;
                    // }

    
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
                        $selled= $item->sells()->create([
                          "user_id"=>$user_id,
                          "type"=>$data->type,
                          'price'=>$data->price,
                          'card_order_id'=>$order->id
                           ]);
                   
                           foreach($item->file()->get() as $files){
                               $selled->file()->create([
                                   'name'=>$files->name,
                                   'user_id'=>$user_id,
                                   'type'=>$files->type,
                                   'url'=>$files->url,
                                   'size'=>$files->size,
                               ]);
                   
                           }
                          
                          $tot= User::findOrFail($item->freelancer_id)->wallet->total ;
                          $tot+= $data->price;
                           User::findOrfail($item->freelancer_id)->wallet()->update([
                               "total"=> $tot,
                              ]);
                         
                   
                              $order->payment()->create([
                               'freelancer_id'=>$item->freelancer_id,
                               'pay_type'=>'bank',
                               "status"=>'purchase',
                               'total'=>$data->price,
                               // 'discount'=>$disvalue,
                               'visapay_id'=>$visa_pay_id,
                       
                           ]);
                     }
                
                     $order->payment()->create([
                        'user_id'=>$user_id,
                        'pay_type'=>$pay_type,
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
