<?php
namespace App\Http\Controllers\Api;
use  Carbon\Carbon;
use App\Models\User;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Notification;
use App\Http\Controllers\Api\ApiResponseTrait;
use App\Notifications\reservation\AcceptOffer;
use App\Notifications\reservation\RejectOffer;
use App\Notifications\reservation\CancelReservationByCustomer;

class ReservationController extends Controller
{
    use ApiResponseTrait;

    public function allReservations(Request $request)
    {   
        try{
            $reservations = Reservation::where('user_id', auth('api')->user()->id)->with('freelancer', 'offer','review')->get();

            foreach($reservations as $reserv){

                if(!stripos($reserv->freelancer->profile_image, "Admin3/assets/images/users/")){
                    $reserv->freelancer->profile_image = asset('Admin3/assets/images/users/'.$reserv->freelancer->profile_image);
              }
            }
          
                return $this->returnData(200, 'Reservations Returned Successfully', $reservations);
        }catch(\Exception $e){
            echo $e;
            return $this->returnError(400, 'Reservations Returned Failed');
        }
    }





    public function createBookingPhotoShot(Request $request, $freelancer_id)
    {
        try{
            $request->validate([
                'occasion' => 'required',
                'date_time' => 'required',
                'from' => 'required',
                'to' => 'required',
                'location' => 'nullable',
            ]);

            $random_id = strtoupper('#'.substr(str_shuffle(uniqid()),0,6));
            while(Reservation::where('random_id', $random_id )->exists()){
                $random_id = strtoupper('#'.substr(str_shuffle(uniqid()),0,6));
            }
        
            $freelancer = User::find($freelancer_id);
                if($freelancer['is_photographer'] == 1){
                    $data = $request->only('occasion', 'date_time', 'from', 'to', 'location');
                        $data['user_id'] = auth('api')->user()->id;
                        $data['freelancer_id'] = $request->freelancer_id;
                        $data['random_id'] = $random_id;
                
                        $from = $data['date_time'].' '.$data['from'];
                        $data['from']= Carbon::create($from, 0);
                        
                        $to = $data['date_time'].' '.$data['to'];
                        $data['to']= Carbon::create($to, 0);
                        Reservation::create($data);
                        
                    return $this->returnData(201, 'Reservation Created Successfully', $data);
                }else{
                    return $this->returnError(500, "Freelancer Doesn't a Photographer");
                }
        }catch(\Exception $e){
            echo $e;
            return $this->returnError(400, 'Reservation Created Failed');
        }
        
    }



    public function getReservationById(Request $request, $id)
    {
        try{
            $reservation = Reservation::find($id);
            if(!$reservation){
                return $this->returnError('404', 'Reservation Not Found');
            }
            return $this->returnData(200, 'Reservation Returned Successfully', $reservation);
        }catch(\Exception $e){
            echo $e;
            return $this->returnError(400, 'Reservation Returned Failed');
        }
    }
    
    
    
    
    public function changeReservationStatus($id)
    {
        try{
            $reservation = Reservation::find($id);
            if($reservation){
                if($reservation['status'] === 'Pending'){
                    Reservation::where('id' , $id)->update(['status' => 'Waiting']);
                }
                if($reservation['status'] === 'Waiting'){
                    Reservation::where('id' , $id)->update(['status' => 'In Process']);
                }
                if($reservation['status'] === 'In Process'){
                    Reservation::where('id' , $id)->update(['status' => 'Finished']);
                }
                if($reservation['status'] === 'Finished'){
                    Reservation::where('id' , $id)->update(['status' => 'Completed']);
                }
                $reservation = Reservation::find($id);
                return $this->returnData(200, 'Reservation Status Changed Successfully', $reservation);
            }else{
                return $this->returnError(400, "Reservation Doesn't Exists");
            }
        }catch(\Exception $e){
            echo $e;
            return $this->returnError(400, 'Reservation Returned Failed');
        }
    }

    public function cancelReservation($id){
     
        try{

            $request=Reservation::find($id);

            if($request->payment()->where('freelancer_id',$request->freelancer_id)->first()){
           
           $total_pay=$request->payment()->where('freelancer_id',$request->freelancer_id)->first()->total;
           $edit_pay=$request->payment()->where('freelancer_id',$request->freelancer_id)->first()->update([
               'status'=>"refund"
           ]);
   
          $current_wallet= User::findOrFail(auth('api')->user()->id)->wallet->total;
           $current_wallet+= $total_pay;
           $edit_offer= Reservation::findorfail($id)->offer()->where('freelancer_id',$request->freelancer_id)->update([
               "status"=>'reject',
           ]);
       }
           $edit_request= $request->update([
               'status'=>"Cancel by customer",
           ]);
   
           $to = User::find($request->freelancer_id);
           $user_create=auth('api')->user()->id;
            Notification::send($to, new CancelReservationByCustomer($user_create,$id,'reservation',  $request->random_id));
            return $this->returnData(200, 'Reservation cancel Successfully');
         
        }catch(\Exception $e){
         echo $e;
         return $this->returnError(400, 'Reservation cancel Failed');
        }
    }

    public function acceptReservation(Request $request,$id,$user_id){

        try{
            $reservation=Reservation::findOrFail($id);
        $offer_total=$reservation->offer->first()->price;
        $payed =false;
        $visa_pay_id=null;
        
            if (request('id') && request('status')=='paid') {
                $paymentService=new \Moyasar\Providers\PaymentService();
                $payment=$paymentService->fetch($request->id);
                if(trim($payment->amountFormat,config('moyasar.currency'))==$offer_total){
                    $request->paytype='visa';
                }
             }
        if($request->paytype=='wallet'){
            $payed = PaymentController::walletpay2($offer_total);
            $pay_type='wallet';
           }elseif($request->paytype=='visa'){
        
            $visa_pay_id=$payment->id;
            $pay_type='bank';
             $payed=true;
             
              
           }elseif($request->paytype=='apay'){
        
            $pay_type='apay';
           }else{
        
           }

           if($payed){
        
             $reservation->offer()->first()->update([
                "status"=>'active',
            ]);
           
            $reservation->update([
               
                'status'=>"Waiting"
            ]);
            $reservation->payment()->create([
             'user_id'=>$userid,
             'freelancer_id'=>$reservation->freelancer_id,
             "status"=>'pending',
             "pay_type"=>$pay_type,
             "total"=>$offer_total,
             "visapay_id"=> $visa_pay_id
            ]);
        
            $freelancer=User::findorfail($reservation->freelancer_id);
            
             Notification::send($freelancer, new AcceptOffer($userid,$id,'reservation', $reservation->random_id));
        
             return $this->returnData(200, 'Reservation accept Successfully');
           }
        
           return $this->returnError(400, 'Reservation Accept Failed');
        
        }catch(\Exception $e){
            echo $e;
            return $this->returnError(400, 'Reservation Accept Failed');
        }
        
    }

    public function ReservationRejectOffer($id){
      try{
        $reservation=Reservation::findorfail($id);
    
        if($reservation->status=='Pending'&&  $reservation->offer->first()->status=='pending' ){
            $reservation->update([

                'status'=>'Rejected',

            ]);
    
            $reservation->offer()->first()->update([
             'status'=>'reject',
             
            ]);
    
            $to = $reservation->freelancer_id;
            $user_create=auth('api')->user()->id;
             Notification::send($to, new RejectOffer($user_create , $id,'reservation',  $reservation->random_id));
    
        }
        return $this->returnData(200, 'Reservation reject  offer successfully');
        
    }catch(\Exception $e){
        echo $e;
        return $this->returnError(400, 'Reservation Accept Failed');
    }
}
    
}
