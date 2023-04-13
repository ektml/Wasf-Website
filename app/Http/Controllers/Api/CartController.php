<?php
namespace App\Http\Controllers\Api;
use App\Models\User;
use  Carbon\Carbon;
use App\Models\Cart;
use App\Models\Photo;
use App\Models\Product;
use App\Models\Discount;
use App\Models\CardOrder;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Api\ApiResponseTrait;

class CartController extends Controller
{
    use ApiResponseTrait;
    
    
     
   
    public function calcCartTotal($discount=null){
        $total=0;
        $price=0;
        $descount=0;
        $walletEnough=false;
          $cartadditems= Cart::where('user_id',auth('api')->user()->id)->get();
        foreach($cartadditems as $item){
            $price+=$item->price;
        }

        if ($discount) {
            
            $descount = $discount->value;
            if($discount->by =="%"){
            
            $total= $price - ( $price * $descount)/100;


        }elseif($discount->by =="$"){
          
            $total=$price-$descount;
            }

            $discount_key=$discount->key;

            if(PaymentController::getuserwallet() >=$total){
            $walletEnough=true ;
            }


            return compact('cartadditems','total','descount','price','discount_key' ,'walletEnough');
        }else{

            $total=$price-$descount;

           if(PaymentController::getuserwallet() >=$total){
            $walletEnough=true ;
           }
         
        }

   
   return compact('cartadditems','total','descount','price','walletEnough');
    }
 
    
}