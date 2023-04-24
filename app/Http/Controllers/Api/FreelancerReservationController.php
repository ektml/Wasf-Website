<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\ApiResponseTrait;


class FreelancerReservationController extends Controller
{
    use ApiResponseTrait;

    function sendOffer(Request $request ,$id){
        
        try{
            $user_id=auth('api')->user()->id;
            $request->validate([
            'offer'=>['required'],
            
             ]);
             $order=Reservation::find($id);
             $order->offer()->create([
              'type'=>"reservation",
               'freelancer_id'=>$user_id,
               'price'=>$request->offer,
               'status'=>'pending',
            
             ]);
             return $this->returnData(200, 'offer send  Successfully');

        }catch(\Exception $e){
            echo $e;
            return $this->returnError(400, "offer not send");
        }
      
    }

    public function editOffer($id){
        try{
        $reservation=Reservation::findorfail($id);
        if($reservation->status=='Rejected'&& $reservation->offer->first()->status=='reject' ){
            $reservation->update([
                'status'=>'Pending',
            ]);
    
            $reservation->offer()->first()->update([
             'status'=>'pending',
             'price'=>request()->offer,
             
            ]);
    
        }
        return $this->returnData(200, 'offer send  Successfully');
    }catch(\Exception $e){
        echo $e;
        return $this->returnError(400, "offer not send");
    }
    
    }
    
    public function finish(){

    }
}
