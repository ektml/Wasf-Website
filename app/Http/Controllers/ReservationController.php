<?php
namespace App\Http\Controllers;
use  Carbon\Carbon;
use App\Models\User;
use App\Models\Requests;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use App\Notifications\reservation\AcceptOffer;
use App\Notifications\reservation\RejectOffer;
use App\Http\Controllers\payment\HayperpayController;
use App\Notifications\reservation\FreelancerPostpone;
use App\Notifications\reservation\CancelReservationByCustomer;
use App\Notifications\reservation\CancelReservationByFreelancer;

class ReservationController extends Controller
{
    public function index($freelancer_id)
    {
        $freelancer = User::find($freelancer_id);
        return view('user.requestreservation', compact('freelancer'));
    }


    public function store(Request $request, $freelancer_id)
    {
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

        
        $data = $request->only('occasion', 'date_time', 'from', 'to', 'location');
        $data['user_id'] = Auth::User()->id;
        $data['freelancer_id'] = $request->freelancer_id;
        $data['random_id']=$random_id;

        $from=$data['date_time'].' '.$data['from'];
        $to=$data['date_time'].' '.$data['to'];
        $data['from']= Carbon::create( $from,0);
        $data['to']= Carbon::create( $to,0);

        Reservation::create($data);
        return redirect()->route('user.reservations');
    }



    public function show(Request $request)
    {
        $user_id = auth()->user()->id;
        $reservations = Reservation::where('user_id', $user_id)->orderBy('status')->get();
        return view('user.showreservation', compact('reservations'));
    }



   


    
    public function changeStatus(Request $request , $id)
    {
        $reservation = Reservation::find($id);
        Reservation::where('id' , $id)->update(['status' => $request->status]);
        return back();
    }

    public function cancel($id)
    {
        $request=Reservation::find($id);

         if($request->payment()->where('freelancer_id',$request->freelancer_id)->first()){
        
        $total_pay=$request->payment()->where('freelancer_id',$request->freelancer_id)->first()->total;
        $edit_pay=$request->payment()->where('freelancer_id',$request->freelancer_id)->first()->update([
            'status'=>"refund"
        ]);

       $current_wallet= User::findOrFail(auth()->user()->id)->wallet->total;
        $current_wallet+= $total_pay;
        $edit_offer= Reservation::findorfail($id)->offer()->where('freelancer_id',$request->freelancer_id)->update([
            "status"=>'reject',
        ]);
    }
        $edit_request= $request->update([
            'status'=>"Cancel by customer"
        ]);

        $to = $request->freelancer_id;
        $user_create=auth()->user()->id;
         Notification::send($to, new CancelReservationByCustomer($user_create,$id,'reservation',  $request->random_id));
        return redirect()->back()->with(['state'=>"canceledInfirst","id"=>$id]);
    }


public function reservationPay(Request $request, $id){


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
     'user_id'=>auth()->user()->id,
     'freelancer_id'=>$reservation->freelancer_id,
     "status"=>'pending',
     "pay_type"=>$pay_type,
     "total"=>$offer_total,
     "visapay_id"=> $visa_pay_id
    ]);

  
    $user_create=auth()->user()->id;
    $freelancer=User::findorfail($reservation->freelancer_id);
    
     Notification::send($freelancer, new AcceptOffer($user_create,$id,'reservation', $reservation->random_id));

     toastr()->success('payment done');
    return redirect()->route('user.reservations')->with(['state'=>"paydone","id"=>$id]);
   }

   toastr()->error('something went wronge');
   return redirect()->back();

}

public function reservationVisaPay(){

$reservation=Reservation::find(request()->res_id);

   $price=$reservation->offer()->first()->price;
    $Hp = new HayperpayController();

 $num=number_format($price, 2, '.', '');
  $res= $Hp->checkout($num);


    $view = view('layouts.payment.ReservationHayperpay')->with(['responseData' => $res ,'res_id'=>$reservation->id])
    ->renderSections();
 
 return response()->json([
    'status' => true,
    'content' => $view['main']
 ]);

}


public function rejectOffer($id){

    $reservation=Reservation::findorfail($id);

    if($reservation->status=='Pending'&&  $reservation->offer->first()->status=='pending' ){
        $reservation->update([
            'status'=>'Rejected',
        ]);

        $reservation->offer()->first()->update([
         'status'=>'reject',
         
        ]);

        $to = $reservation->freelancer_id;
        $user_create=auth()->user()->id;
         Notification::send($to, new RejectOffer($user_create,$id,'reservation',  $reservation->random_id));

    }


    toastr()->success('offer reject successfully');
   return redirect()->back()->with(["state"=>'Rejected','id'=>$id]);
} 


public function acceptdelay($id){

 $reservation=Reservation::findorfail($id);
 $date=$reservation->delay()->first()->delayto;
 $delayTime = $reservation->delay()->first()->delayto;
$to=new Carbon($reservation->to,0);
$to=$to->toTimeString();
 $to=$date . " ". $to;
 $to=new Carbon($to);
$from=new Carbon($reservation->from,0);
$from=$from->toTimeString();
 $from=$date . " ". $from;
 $from=new Carbon($from);



//  Carbon::create()
 $reservation->update([

    'status'=>"Waiting",
    'date_time'=>$reservation->delay()->first()->delayto,
    'from'=>$to,
    'to'=>$from

 ]);

toastr()->success('accepted delay successfully');
return redirect()->back()->with(["state"=>'Waiting','id'=>$id]);
}












    // freelancer 


    public function freelancerReservations(Request $request)
    {
        $freelancer_id = auth()->user()->id;
        $reservations = Reservation::where('freelancer_id', $freelancer_id)->get();
        return view("freelancer.showreservation", compact('reservations'));
    }


    public function rejectReservation($id){


       $re= Reservation::findOrFail($id);
       $re->update([
        'status'=>'reject',
       ]);

  return redirect()->back()->with(['state'=>"rejected","id"=>$id]);

    }



    


    // send offer for reesrvation from freelancer
    public function sendoffer(Request $request ,$id){
 
        $user_id=auth()->user()->id;
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
      
        toastr()->success('offer is send');

    return redirect()->back()->with(['state'=>"offersend","id"=>$id]);

    }

    function finish($id){


        Reservation::findorfail($id)->update([
          "status"=>"Finished",
          
        ]);
        return  redirect()->back()->with(['message'=>"request update finished"]);
    }

    function  compelete($id){

        $re=Reservation::findorfail($id);
        $freelnacer_id=$re->first()->freelancer_id;
        $offer_price=$re->offer->first()->price;
          
        $wallet=User::findOrFail($freelnacer_id)->wallet->total;

        $wallet+=$offer_price;
        $re->update([
            "status"=>"Completed",
            
          ]);


          $edit_wallet=User::findOrFail($freelnacer_id)->wallet()->update([
            "total"=> $wallet
           ]);
      

           $re->payment()->where('freelancer_id', $freelnacer_id)->update([
            'status'=>'purchase'
            ]);
          
            toastr()->success('completed successfully');
          return  redirect()->back()->with(['message'=>"request update finished",'state'=>"completed",'id'=>$id]);
        

    }


    
public function review($id,Request $req)
{
    $res=Reservation::find($id);
    $freelancer_id=$res->freelancer_id;
    $s= $res->review()->create([
          'freelancer_id'=>$freelancer_id,
          'rate'=> $req->rate,
          'pragraph'=> $req->pragraph,
          'user_id'=>auth()->user()->id
        
    ]);
    toastr()->success('review send successfully');
    return redirect()->back()->with(['message'=>"completed","id"=>$id,'state'=>"completed"]);
}


public function editOffer($id){

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

    toastr()->success('offer is edit sucessfully');

    return redirect()->back()->with(['state'=>'offeredit' ,'id'=>$id]);

}


public function cancelReservation($id){

    $request=Reservation::find($id);

    if($request->payment()->where('freelancer_id',$request->freelancer_id)->first()){
   
   $total_pay=$request->payment()->where('freelancer_id',$request->freelancer_id)->first()->total;
   $edit_pay=$request->payment()->where('freelancer_id',$request->freelancer_id)->first()->update([
       'status'=>"refund"
   ]);

  $current_wallet= User::findOrFail(auth()->user()->id)->wallet->total;
   $current_wallet+= $total_pay;
   $edit_offer= Reservation::findorfail($id)->offer()->where('freelancer_id',$request->freelancer_id)->update([
       "status"=>'reject',
   ]);
}
   $edit_request= $request->update([
       'status'=>"Cancel by freelancer"
   ]);


   $to = $request->user_id;
   $user_create=auth()->user()->id;
    Notification::send($to, new CancelReservationByFreelancer($user_create,$id,'reservation',  $request->random_id));
   return redirect()->back()->with(['state'=>"canceled","id"=>$id]);
}



public function postReservation( Request $request,$id){
    $request->validate([
        'reason'=>'required',
        'delayto'=>'required',
    ]);

    $reservation=Reservation::findorfail($id);


    if($reservation->status=='Waiting'){
        $reservation->delay()->create([
            'reason'=>$request->reason,
            'delayto'=>$request->delayto,
        ]);

        $reservation->update([
         'status'=>'Posted by freelancer',
         
        ]);

    }

    $to = $reservation->user_id;
    $user_create=auth()->user()->id;
     Notification::send($to, new FreelancerPostpone($user_create,$id,'reservation',  $reservation->random_id));
    toastr()->success('posted  sucessfully');

    return redirect()->back()->with(['state'=>'posted' ,'id'=>$id]);
}



}
