<?php
namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Offer;
use App\Models\Review;
use App\Models\Category;
use App\Models\Requests;
use Illuminate\Http\Request;
use App\Models\FreelancerService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Notifications\requests\RejectOffer;
use Illuminate\Support\Facades\Notification;
use App\Notifications\requests\CreateRequest;
use App\Http\Controllers\payment\HayperpayController;
use App\Notifications\requests\CancelRequestByCustomer;


class RequestController extends Controller
{
    public function index()
    {
        // $categories = Category::all();
        // return view('user.requestpublicservice', compact('categories'));
    }



    public function requestUserToFreelancer($id)
    {
        $freelancer = User::find($id);
        $categories = Category::all();
        return view('user.requestprivateservice', compact('freelancer','categories'));
    }

    public function choseRequestOrReservation($id)
    {
        if(request()->requesttype=='private'){
            $freelancer = User::find($id);
            $categories = Category::all();
            return view('user.requestprivateservice', compact('freelancer','categories'));
        }else{

            $freelancer = User::find($id);
            $categories = Category::all();
            return view('user.requestreservation', compact('freelancer'));

        }
        
    }



    public function requestpublicservice(){

        $categories = Category::all();
        return view('user.requestpublicservice', compact('categories'));
    }

// store public and private  requests
    public function store(Request $request , $freelancer_id = null)
    {
        $user_id= auth()->user()->id;
        $this->validate($request, [
            'category_id' => 'required',
            'service_id' => 'nullable',
            'title' => 'required|string',
            'attachment' => 'required',
            // 'attachment' => 'required|mimes:pdf,word',
            'description' => 'required',
            'due_date' => 'required|date',
            'type' => [\Illuminate\Validation\Rule::in(['public','private'])]
        ],[
            'category_id.required' => 'Category is required',
            'service_id.required' => 'Service is required',
            'title.required' => 'Request Title is required',
            'title.mimes' => 'Request Title must be pdf',
            'attachment.required' => 'Request Attachment is required',
            'description.required' => 'Description is required',
            'due_date.required' => 'Due Date is required',
        ]);


        $random_id = strtoupper('#'.substr(str_shuffle(uniqid()),0,6));
        while(Requests::where('random_id', $random_id )->exists()){
            $random_id = strtoupper('#'.substr(str_shuffle(uniqid()),0,6));
        }

        if($request->type == 'public'){
            $re= Requests::create([
                'title'=>$request->title,
                'random_id'=>$random_id,
                'category_id'=>$request->category_id,
                'service_id'=>$request->service_id,
                'description'=>$request->description,
                'due_date'=>$request->due_date,
                'user_id'=>$user_id,
                'type'=>'public',
            ]);

        }elseif($request->type=='private'){
            $re= Requests::create([
                'title'=>$request->title,
                'random_id'=>$random_id,
                'category_id'=>$request->category_id,
                'service_id'=>$request->service_id,
                'description'=>$request->description,
                'due_date'=>$request->due_date,
                'freelancer_id'=>$freelancer_id,
                'user_id'=>$user_id,
                'type'=>'private',
            ]);
        }

        $name= explode(".",$request->file("attachment")->getCLientOriginalName())[0];
        $size=number_format($request->file("attachment")->getSize()/ 1024,2);
        $type=$request->file("attachment")->getCLientOriginalExtension();
        $file_extention = $request->file("attachment")->getCLientOriginalExtension();
        $attachment_name=time(). ".".$file_extention;
        $request->file("attachment")->move(public_path('front/upload/files/'),$attachment_name);

        $re->file()->create([
            'name'=> $name,
            'user_id'=>auth()->user()->id,
            'type'=>$type,
            'url'=> $attachment_name,
            'size'=>$size,
        ]);

 $freelancer_detail = [];
if($request->type=='public'){
    if($request->service_id ==null){

        $freelancers = FreelancerService::where('parent_id',null)
        ->where('service_id',request()->cat_id)->where('freelancer_id','!=',auth()->user()->id)->get();
       
        foreach ($freelancers as $freelancer) {
            $data = User::find($freelancer->freelancer_id);
            array_push($freelancer_detail,$data);
        }
    
    }else{
        $freelancers = FreelancerService::where('parent_id',$request->category_id)
        ->where('service_id',$request->service_id)->where('freelancer_id','!=',auth()->user()->id)->get();
       
        foreach ($freelancers as $freelancer) {
            $data = User::find($freelancer->freelancer_id);
        //    $freelancer_detail->push($data);
           array_push($freelancer_detail,$data);
        }
    }
    
}else{
    $freelancer_detail=User::where('id',$freelancer_id)->get();
}
        $users = User::where('id' , '!=' , auth()->user()->id)->get();
        $user_create = auth()->user()->id;
        
        Notification::send($freelancer_detail, new CreateRequest($user_create,$re->id,'request',$re->random_id));

        if($request->type='public'){
            return  redirect()->route('user.showpublicrequest')->with( ['messsage' => 'ok'] );
            
        }else{
            return  redirect()->route('user.showprivaterequest')->with( ['messsage' => 'ok'] );
        }
       
    }


    public function getCategoryServices($id)
    {
        if(app()->getLocale()=='ar'){
            $services = DB::table("services")->where("category_id" , $id)->pluck("service_ar" , "id");
        }else{
            $services = DB::table("services")->where("category_id" , $id)->pluck("service_en" , "id");
        }
        return json_encode($services);
    }


    public function publicRequests()
    {

        $filter=[];
       
        if(isset(request()->search)){
            $requests = Requests::where('type', 'public')->where("user_id", auth()->user()->id)->orderBy('status')->get();         
                if(in_array('datedesending',request()->search)){
                    $requests =$requests->sortByDesc('due_date');
                    array_push($filter,'datedesending');
                }
                if(in_array('pendding',request()->search)){
                    $requests =$requests->where('status','Pending');
                    array_push($filter,'pendding');
                }
                if(in_array('datadesending',request()->search)){
                    $requests =$requests->sortByDesc('due_date');
                }
                if(in_array('datadesending',request()->search)){
                    $requests =$requests->sortByDesc('due_date');
                }
                $requests=$requests->paginate(20);

        }else{

            $requests = Requests::where('type', 'public')->where("user_id", auth()->user()->id)->orderBy('status')->get();
            $requests=$requests->paginate(20);
        }
      

        return view('user.showpublicrequest', compact('requests','filter'));
    }




    public function privateRequests()
    {
        $requests = Requests::where('type', 'private')->where("user_id", auth()->user()->id)->orderBy('status')->get();

        return view('user.showprivaterequest', compact('requests'));
    }




    public function cancel($id)
    {
        $request=Requests::find($id);

         if($request->payment()->where('freelancer_id',$request->freelancer_id)->first()){
        
        $total_pay=$request->payment()->where('freelancer_id',$request->freelancer_id)->first()->total;
        $edit_pay=$request->payment()->where('freelancer_id',$request->freelancer_id)->first()->update([
            'status'=>"refund"
        ]);

       $current_wallet= User::findOrFail(auth()->user()->id)->wallet->total;
        $current_wallet+= $total_pay;
        $edit_offer= Requests::findorfail($id)->offer()->where('freelancer_id',$request->freelancer_id)->update([
            "status"=>'reject',
        ]);

        $freelancer= User::find($request->freelancer_id);
        $user_create=auth()->user()->id;
    
         Notification::send($freelancer, new CancelRequestByCustomer($user_create,$id,'request', $request->random_id));

        toastr()->success('cancel successfully');
        return redirect()->back()->with(['state'=>"cancel","id"=>$id]);
    }
        $edit_request= $request->update([
            'status'=>"Cancel by customer"
        ]);


        $freelancer= User::find($request->freelancer_id);
        $user_create=auth()->user()->id;
        $request=Requests::find($request_id);
         Notification::send($freelancer, new CancelRequestByCustomer($user_create,$id,'request', $request->random_id));

         

        toastr()->success('cancel successfully');
        return redirect()->back();
        
    }




    public function review($id,Request $req)
    {
        $request=Requests::find($id);
        $freelancer_id=$request->freelancer_id;
        $request=Requests::find($id);
        $s= $request->review()->create([
              'freelancer_id'=>$freelancer_id,
              'rate'=> $req->rate,
              'pragraph'=> $req->pragraph,
              'user_id'=>auth()->user()->id
            
        ]);
        return redirect()->back()->with(['message'=>"completed","id"=>$id,]);
    }






    public function  getrequestoffer($id){

    $requests=Requests::findorfail($id);

     $requestsoffer=$requests->offer()->select('freelancer_id','price','id')->where('status','pending')->get();

$data="";
     foreach(  $requestsoffer  as $re){
    
       $data.=' <div class="freelanceroffer ">
        <div class=" d-flex "> 
            <div class="img">
        <img src="'.asset( 'Admin3/assets/images/users/'.User::findOrFail($re->freelancer_id)->profile_image).'" alt="">
            </div>

 

            <div class="info d-flex flex-column">
                <h5 class="mb-0">'. User::findOrFail($re->freelancer_id)->name  .'</h5>
                <p class="mb-0"><span style="font-weight:600" class="mb-0 ">'. $re->price .'</span> <span style="font-size:12px;color:#777">Rs</span>
                </p>

                <div class="d-flex">
                    <div class="d-flex align-items-baseline ">
                        <i class="fa-solid fa-star"></i>
                        <p class="mb-0">';
                        if(Review::select('rate')->where('freelancer_id',$re->freelancer_id)->count() > 0){
                            $data.=    Review::select('rate')->where('freelancer_id',$re->freelancer_id)->sum('rate')/  Review::select('rate')->where('freelancer_id',$re->freelancer_id)->count();
                        }else{
                            $data.=   Review::select('rate')->where('freelancer_id',$re->freelancer_id)->count();
                        }
                            $data.=
                        '</p>
                    </div>

                    <div class="d-flex align-items-baseline px-2">
                        <i class="fa-solid fa-clipboard-check align-items-baseline"></i>
                        <p class="mb-0">7</p>
                    </div>
                </div>
            </div>
        </div>

        <div class=" buttoncontainer d-flex align-items-around justify-content-around position-relative">
        <form  method="GET" class="reject'.$id.'" onsubmit="event.preventDefault();" >
        <input type="hidden" name="request_id" value="'.$id.'">
        <input type="hidden" name="freelancer_id" value="'.$re->freelancer_id.'">
        <input type="hidden"  name="_token" value='.csrf_token().'>

        <button class="btn rej rounded-pill px-3 py-2 " type="submit"> reject</button>
        </form>


        <form action="'. route("user.acceptoffertopay",[$re->id,$id]) .'" method="GET">
        <button class="btn accept rounded-pill px-3 py-2" >accept</button>
        </form>

        </div>
    </div>';
    }
    if(strlen($data)>0 and $data!=null){
        return JSON_encode( $data);

    }else{
        if(app()->getLocale()=='ar'){
            $data="لا يوجد عروض متاحه";
        }else{
            $data="no offer";
        }
        return JSON_encode( $data);
    }
}





    function rejectofferrequest(Request $request){
     $flag=false;
    // $request_id=$request->request_id;
    $request_id= request("request_id");
    $freelancer_id=request("freelancer_id");

    $requests=Requests::findOrFail($request_id);
     $requests->offer()->where('freelancer_id',$freelancer_id)->update([
    'status'=>'reject'
    ]);


    $freelancer= User::find($freelancer_id);
    $user_create=auth()->user()->id;
   
     Notification::send($freelancer, new RejectOffer($user_create,$request_id,'request',  $requests->random_id));
    $flag=true;

    return JSON_encode($flag);
    }


    function acceptoffertopay($id ,$re){


       $offer_price= Offer::where('id',$id)->first()->price;

       $wallet=User::findOrFail(auth()->user()->id)->wallet->total;


       $pay_wallet=( $wallet>=$offer_price)?1:0;


    return redirect()->back()->with(['message'=>'open payment','offer_id'=>$id,'request_id'=>$re,'pay_wallet'=>$pay_wallet]);
    }



   public  function checkoutvisaid(){

        $request=Requests::find(request()->request_id);

        $price= Offer::find(request()->offer_id)->first()->price;
         $Hp = new HayperpayController();
     
      $num=number_format($price, 2, '.', '');
       $res= $Hp->checkout($num);
     
     
         $view = view('layouts.payment.privateRequestHayperpay')->with(['responseData' => $res ,'request_id'=>request()->request_id,'offer_id'=>request()->offer_id])
         ->renderSections();
      
      return response()->json([
         'status' => true,
         'content' => $view['main']
      ]);

    }

    function  completeRequest($id){

        $re = Requests::findOrFail($id);
        $freelnacer_id=$re->freelancer_id;
        $offer_price=$re->offer()->where('freelancer_id',$freelnacer_id)->first()->price;
          
        $wallet=User::findOrFail($freelnacer_id)->wallet->total;

        $wallet+=$offer_price;
        Requests::findorfail($id)->update([
            "status"=>"Completed",
            
          ]);

        $re->payment()->where('freelancer_id', $freelnacer_id)->update([
        'status'=>'purchase'
        ]);

          $edit_wallet=User::findOrFail( $freelnacer_id)->wallet()->update([
            "total"=> $wallet
           ]);
      

           toastr()->success('completed successfully');
          return  redirect()->back()->with(['message'=>"request update finished",'status'=>"completed",'request_id'=>$id]);
        

    }

    function privaterejectoffer($id){

        $requests=Requests::findOrFail($id);
     $requests->offer()->update([
    'status'=>'reject'
    ]);
    $requests->update([
        'status'=>'Reject',

        ]);
 
        $freelancer= User::find( $requests->offer()->first()->freelancer_id);
        $user_create=auth()->user()->id;
         Notification::send($freelancer, new RejectOffer($user_create,$id,'request',  $requests->random_id));

    return redirect()->back()->with(['message'=>__('reject offer message')]);
    }


    
  function privateracceptoffer($id){

     $requests=Requests::findOrFail($id);

    $re= $requests->offer->first()->id;
       $offer_price= $requests->offer->first()->price;

       $wallet=User::findOrFail(auth()->user()->id)->wallet->total;
    
       $pay_wallet=( $wallet>=$offer_price)?1:0;
    return redirect()->back()->with(['message'=>'open payment','offer_id'=> $re,'request_id'=>$id,'pay_wallet'=>$pay_wallet]);
    }



    public function searchNewOffer($id){
        $request=Requests::find($id);

        if($request->payment()->where('freelancer_id',$request->freelancer_id)->first()){
       
       $total_pay=$request->payment()->where('freelancer_id',$request->freelancer_id)->first()->total;
       $edit_pay=$request->payment()->where('freelancer_id',$request->freelancer_id)->first()->update([
           'status'=>"refund"
       ]);

      $current_wallet= User::findOrFail(auth()->user()->id)->wallet->total;
       $current_wallet+= $total_pay;
       $edit_offer= Requests::findorfail($id)->offer()->where('freelancer_id',$request->freelancer_id)->update([
           "status"=>'reject',
       ]);


       $freelancer= Requests::findorfail($id)->offer()->where('freelancer_id',$request->freelancer_id);
       $user_create=auth()->user()->id;
        Notification::send($freelancer, new RejectOffer($user_create,$id,'request',  $requests->random_id));

   }
   $request->blacklist()->create([
    'freelancer_id'=>$request->freelancer_id
   ]);
       $edit_request= $request->update([
           'status'=>"Pending",
           'freelancer_id'=> null,
       ]);       
       toastr()->success('edit done successfully');
       return redirect()->back()->with(['state'=>"pending","id"=>$id]);

    }


}
//onsubmit="event.preventDefault(); return rejectoffer(this)"

