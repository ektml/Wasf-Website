<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use App\Notifications\requests\CancelRequestByFreelancer;


class FreelancerRequestController extends Controller
{
    

    public function  getneworder(){
       $user_id=auth()->user()->id;
       $privates=[];
       $publics=[];


        $privatesx =  Requests::where('type','private')->where("status",'Pending')->where('freelancer_id',$user_id)->get();



        foreach(  $privatesx  as $p){

            if($p->type =='private' && $p->status =='Pending' && $p->offer->where('freelancer_id',$user_id)->first()!=null){
                
                if($p->type =='private' && $p->status =='Pending' && in_array($p->offer->where('freelancer_id',$user_id)->first()->status,['accept','pending'])){
                    continue;
                }
              

         } 
        
            array_push($privates,$p);
        }
        $publicsx=Requests::where('type','public')->where('status','Pending'
        )->whereNull('freelancer_id')->get();


        foreach( $publicsx as $p){
           
            if($p->type =='public' && $p->status =='Pending' && $p->offer->where('freelancer_id',$user_id)->first()!=null){
                if($p->type =='public' && $p->status =='Pending' && in_array($p->offer->where('freelancer_id',$user_id)->first()->status,['accept','pending'])){
                    continue;

                }
                if($p->type =='public' && $p->status =='Pending' &&$p->blacklist()->exists() && $user_id==$p->blacklist()->where('freelancer_id',$user_id)->first()->freelancer_id){

                 
                    continue;

                }
               

              

         } 

            array_push($publics,$p);
        }

        // dd($publics);
        return view('freelancer.neworder',compact('privates','publics'));
    }



    public function sendoffer(Request $request ,$id){
 
        $flag=false;
        $user_id=auth()->user()->id;
     $request->validate([
       'offer'=>['required'],
       'type'=>['required'],
     ]);

     if($request->type ==="request"){
        $order=Requests::find($id);
        $order->offer()->create([
         'type'=>"request",
          'freelancer_id'=>$user_id,
          'price'=>$request->offer,
          'status'=>'pending',
       
        ]);
      
        $flag=true;

     }elseif($request->type === "reservation"){


        $flag=true;
     }

    


if($flag){

    return redirect()->back()->with('message','offer is send');
}


    }





    public function getmywork(){
        $user_id=auth()->user()->id; 

        $privates= Requests::where(function($q)use( $user_id){
           $q->where('freelancer_id',$user_id)->orWhere('freelancer_id',null);
        })->orderBy('status')->get();

        $result=[];


        foreach(  $privates as $p){

            if( $p->status =='Pending' && $p->offer->where('freelancer_id',$user_id)->first()==null){

                continue;

         } elseif( $p->status =='Pending' && in_array($p->offer->where('freelancer_id',$user_id)->first()->status,['reject'])){
            continue;

            }

            array_push($result,$p);
        }
     


   



        // $privates= $privatesw->offer->get();
//         $privates = Requests::where('type','private')->where(function($q){
// $q->where('status','Pending')->orWhere('status','In process')->orWhere('status','Finished')->orWhere('status','Completed');
//         })->where('freelancer_id',$user_id)->offer->chunck();

// $privates = Requests::select('requests.*')->leftJoin('offers', function($q) use($user_id) {
//     $q->on('offers.offersable_id', '=', 'requests.id');
//     $q->where('offers.offersable_type', '=', 'App\Models\Requests');
//     // $q->where('offers.status','=','pending');
//     // $q->orWhere('offers.status','=','active');
//     $q->where('requests.status','=','public');
//     // $q->orWhere('requests.status','=','private');
//     // $q->where('requests.freelancer_id','=',$user_id);
//     // $q->orWhere('requests.freelancer_id','=','null');
    
// })->get();



        // $publics=Requests::where('type','public')->where(function($q){
        //     $q->where('status','Pending')->orWhere('status','In process')->orWhere('status','Finished')->orWhere('status','Completed');
        //             })->get();

        //  dd($privates);
        return view('freelancer.mywork',compact('result'));
    }



    function finishRequest($id){


        Requests::findorfail($id)->update([
          "status"=>"Finished",
          
        ]);
        return  redirect()->back()->with(['message'=>"request udate finished"]);
    }




    public function cancel($id)
    {
        $request=Requests::find($id);
        $freelancer_id=auth()->user()->id;
         if($request->payment()->where('freelancer_id',$freelancer_id)->first()){
        
        $total_pay=$request->payment()->where('freelancer_id',$freelancer_id)->first()->total;
        $edit_pay=$request->payment()->where('freelancer_id',$freelancer_id)->first()->update([
            'status'=>"refund"
        ]);

       $current_wallet= User::findOrFail($request->user_id)->wallet->total;
        $current_wallet+= $total_pay;
        $edit_offer= Requests::findorfail($id)->offer()->where('freelancer_id',$freelancer_id)->update([
            "status"=>'reject',
        ]);

        $user= User::find($request->user_id);
        $user_create=auth()->user()->id;
         Notification::send($user, new CancelRequestByFreelancer($user_create,$id,'request', $request->random_id));


        toastr()->success('cancel successfully');
        return redirect()->back()->with(['state'=>"cancel","id"=>$id]);
    }

$flag=false;

    if($request->type=='private'){
        $edit_request= $request->update([
            'status'=>"Cancel by freelancer"
        ]);
        $flag=true;
    }elseif($request->type=='public'){

        $edit_offer= Requests::findorfail($id)->offer()->where('freelancer_id',$freelancer_id)->update([
            "status"=>'reject',
        ]);

        Requests::findorfail($id)->blacklist()->create([
            'freelancer_id'=>auth()->user()->id,
        ]);

        $flag=true;
    }


       

    if($flag){

    $user= User::find($request->user_id);
    $user_create=auth()->user()->id;
    
     Notification::send($user, new CancelRequestByFreelancer($user_create,$id,'request', $request->random_id));
     
            toastr()->success('cancel successfully');
        }else{
            toastr()->error('cancel fail');
        }
                
            
        return redirect()->back();
        
    }

    public function editoffer($id){

        $req=Requests::findorfail($id);
        $freelancer_id=auth()->user()->id;


        if( $req->offer()->where('freelancer_id',$freelancer_id)->exists()){

            if( $req->status=='Reject' &&  $req->offer->first()->status == 'reject'){

              
                $req->update([
                    'status'=>'Pending',
                ]);
    
                $req->offer()->first()->update([
                 'status'=>'pending',
                 'price'=>request()->offer,
                 
                ]);
        
            }else{
               $req->offer()->where('freelancer_id',$freelancer_id)->update([
                    'status'=>'pending',
                    'price'=>request()->offer,
                   ]);
    
            }
            toastr()->success('offer is edit sucessfully');
            return redirect()->back()->with(['state'=>'offeredit' ,'id'=>$id]);
        }
       
    
        toastr()->success('offer is edit fail');
    
        return redirect()->back()->with(['state'=>'offeredit' ,'id'=>$id]);

    }
}
