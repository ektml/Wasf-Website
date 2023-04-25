<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Notification;
use App\Http\Controllers\Api\ApiResponseTrait;
use App\Notifications\reservation\CancelReservationByFreelancer;


class FreelancerReservationController extends Controller
{
    use ApiResponseTrait;




    public function getFreelancerReservationNew(){

        try{
            $re=Reservation::where('status','Pending')->where('freelancer_id',auth('api')->user()->id)->with(
            'offer','user','review'
            )->get();

            $reservation=[];
            foreach($re as $reserv){

                if(!stripos($reserv->user->profile_image, "Admin3/assets/images/users/")){
                    $reserv->user->profile_image = asset('Admin3/assets/images/users/'.$reserv->user->profile_image);
                }
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
            $re=Reservation::where('freelancer_id',auth('api')->user()->id)->with(
            'offer','user','review'
            )->get();

            $reservation=[];
            foreach($re as $reserv){

                if(!stripos($reserv->user->profile_image, "Admin3/assets/images/users/")){
                    $reserv->user->profile_image = asset('Admin3/assets/images/users/'.$reserv->user->profile_image);}
                if($reserv->status =='Pending'){
                    if( $reserv->offer->first()!=null && in_array($reserv->offer->first()->status ,['active','pending'])){
                        $reservation[]= $reserv;
                  }else{
                    continue;
                  }
                }
                else{
                    $reservation[]= $reserv;
                }

                if($reserv->status == 'Waiting' &&
                $reserv->date_time==now()->toDateString() && ($reserv->from<=now()
                    ||$reserv->to <=now())){
                      $reserv->status="In Process";
                    }
            }

            return $this->returnData(200, 'Reservations Returned Successfully',$reservation);

        }catch(\Exception $e){
            echo $e;
            return $this->returnError(400, "Reservations Returned fail");
        }
    }
    function sendOffer(Request $request,$id){
        
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


    public function freelancerCancelReservation($id){

        try{

            $request=Reservation::find($id);
    
            if($request->payment()->where('freelancer_id',$request->freelancer_id)->first()){
           
           $total_pay=$request->payment()->where('freelancer_id',$request->freelancer_id)->first()->total;
           $edit_pay=$request->payment()->where('freelancer_id',$request->freelancer_id)->first()->update([
               'status'=>"refund",
           ]);
        
          $current_wallet= User::findOrFail(auth('api')->user()->id)->wallet->total;
           $current_wallet+= $total_pay;
           $edit_offer= Reservation::findorfail($id)->offer()->where('freelancer_id',$request->freelancer_id)->update([
               "status"=>'reject',
           ]);
        }
           $edit_request= $request->update([
               'status'=>"Cancel by freelancer"
           ]);
        
        
           $to = User::findorfail($request->user_id);
           $user_create=auth('api')->user()->id;
            Notification::send($to, new CancelReservationByFreelancer($user_create,$id,'reservation',  $request->random_id));
          
            return $this->returnData(200, 'reservation cancel  Successfully');
        }
    
            
                catch(\Exception $e){
        echo $e;
                    return $this->returnError(400, "reservation cancel failed");
                }
            
        }


}
