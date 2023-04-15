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
    
    
     
   
    public function calcCartTotal($user_id,$discount=null){
        $total=0;
        $price=0;
        $descount=0;
        $walletEnough=false;
          $cartadditems= Cart::where('user_id',$user_id)->get();
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

            if(User::findOrFail($user_id)->wallet->total >=$total){
            $walletEnough=true ;
            }
            
             $total=round($total,2);

            return compact('cartadditems','total','descount','price','discount_key' ,'walletEnough');
        }else{

            $total=$price-$descount;
            
             $total=round($total,2);

           if(User::findOrFail($user_id)->wallet->total >=$total){
            $walletEnough=true ;
           }
         
        }

   
   return compact('cartadditems','total','descount','price','walletEnough');
    }
 
 
         public function cartCalcDiscount(Request $request){
             
             
             try{
             $total=0;
             $discount=null;
             if(isset($request->price)&& isset($request->promo)){
                 
                 $price = $request->price;
                $discount=Discount::where('key',$request->promo)->first(); 
                
                  if ($discount) {
                        
                        $descount = $discount->value;
                        if($discount->by =="%"){
                        
                        $total= $price - ( $price * $descount)/100;
            
            
                    }elseif($discount->by =="$"){
                      
                        $total=$price-$descount;
                        }
                        
                      $total=number_format($total,2);
                  return $this->returnData(201, 'there is discount' ,compact('total','discount'));
             }else{
                 $total=$price;
                 
                  return $this->returnData(201, 'there is no' ,compact('total','discount'));
                 
             }
            
             
             
         }else{
                return $this->returnError(400,'some thing went wrong');
         }
         
             }catch(\Exception $e){
                  return $this->returnError(400,'some thing went wrong');
             }
         }
}