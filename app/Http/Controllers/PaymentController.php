<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Offer;
use App\Models\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use App\Notifications\requests\AcceptOffer;
use App\Http\Services\PayTabs;
use App\Http\Controllers\payment\HayperpayController;

class PaymentController extends Controller
{

    //for request only
    function walletpay( Request $request){

       
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
            "total"=>$total_wallet_after_pay
           ]);

        if( $edit_offer && $edit_request && $edit_pay &&$edit_wallet ){
           $freelancer= User::find($freelancer_id);
           $user_create=auth()->user()->id;
           $request=Requests::find($request_id);
            Notification::send($freelancer, new AcceptOffer($user_create,$request_id,'request', $request->random_id));
            return redirect()->back()->with(["message"=>'paydone']);

        }else{
           
            return redirect()->back()->with(["message"=> "payfail",'content'=>'some thing went wrong']);
        }
   
        }else{
          
            return redirect()->back()->with(["message"=> "payfail",'content'=>'money not enough']);

        }
        


        
    }

//for request only
    static function bankpay($request_id,$offer_id){
        $offer_id=request()->offer_id;
        $request_id=request()->request_id;
        $offer_price= Offer::where('id',$offer_id)->first()->price;
        $freelancer_id= Offer::where('id',$offer_id)->first()->freelancer_id;
        $edit_offer =null;
       $edit_request =null;
       $edit_pay =null;
        
        
        if (request()->id && request()->status=='paid') {
            $paymentService = new \Moyasar\Providers\PaymentService();
            $payment = $paymentService->fetch(request()->id);
       
           
       if(trim($payment->amountFormat,config('moyasar.currency'))==$offer_price){
        
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
          'user_id'=>auth()->user()->id,
          'freelancer_id'=>$freelancer_id,
          "status"=>'pending',
          "pay_type"=>'bank',
          "total"=>$offer_price,
          "visapay_id"=> $visa_pay_id
         ]);
       }
      
    

    }
         
        if( $edit_offer && $edit_request && $edit_pay  ){
  
            $freelancer= User::find($freelancer_id);
           $user_create=auth()->user()->id;
           $request=Requests::find($request_id);
            Notification::send($freelancer, new AcceptOffer($user_create,$request_id,'request', $request->random_id));
            
            return redirect()->back()->with(["state"=>'paydone']);

        }else{
            toastr()->error('some thing went wrong');
            return redirect()->back();
        }
   
      
    }




    static function apay(){
        
    }


    static function walletpay2($total){
   
        if(SELF::getuserwallet()>=$total){
            $total_wallet_after_pay=SELF::getuserwallet() - $total;
            $edit_wallet=User::findOrFail(auth()->user()->id)->wallet()->update([
                "total"=>$total_wallet_after_pay,
               ]);


               return true;
        }
       
            return false;
        
    }

   static function getuserwallet(){
      
       return User::findOrFail(auth()->user()->id)->wallet->total;
    }


   
}
