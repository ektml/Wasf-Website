<?php

namespace App\Http\Controllers\Api;

use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\ApiResponseTrait;


class FreelancerReservationController extends Controller
{
    use ApiResponseTrait;




    public function getFreelancerReservationNew(){

        try{
            $re=Reservation::where('status','Pending')->where('freelancer_id',auth('api')->user()->id)->with(
            'offer','user'
            )->get();

            $reservation=[];
            foreach($re as $reserv){

                if($reserv->offer->first() !=null  && in_array($reserv->offer->first()->status ,['active','pending'])){
                      continue;
                }else{
                    $reservation[]= $reserv;
                }


            }

            return $this->returnData(200, 'Reservations Returned Successfully',$reservation);

        }catch(\Exception $e){
            echo $e;
            return $this->returnError(400, "Reservations Returned fail");
        }
    }


    public function getFreelancerMyReservation(){

        try{
            $re=Reservation::where('status','Pending')->where('freelancer_id',auth('api')->user()->id)->with(
            'offer','user'
            )->get();

            $reservation=[];
            foreach($re as $reserv){

                if($reserv->status =='Pending' && in_array($reserv->offer->first()->status ,['reject'])){
                      continue;
                }else{
                    $reservation[]= $reserv;
                }


            }

            return $this->returnData(200, 'Reservations Returned Successfully',$reservation);

        }catch(\Exception $e){
            echo $e;
            return $this->returnError(400, "Reservations Returned fail");
        }
    }
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
    
    public function finish($id){
          try{
            Reservation::findorfail($id)->update([
                "status"=>"Finished",
              ]);
            return $this->returnData(200, 'reservation finish  Successfully');
        }catch(\Exception $e){
            echo $e;
            return $this->returnError(400, "reservation finish failed");
        }
        
    }


}
