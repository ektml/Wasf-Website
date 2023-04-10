<?php
namespace App\Http\Controllers\Api;
use App\Models\User;
use  Carbon\Carbon;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Api\ApiResponseTrait;

class ReservationController extends Controller
{
    use ApiResponseTrait;

    public function allReservations(Request $request)
    {   
        try{
            $reservations = Reservation::where('user_id', auth('api')->user()->id)->with('freelancer', 'offer')->get();
            
          
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
}
