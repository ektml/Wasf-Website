<?php
namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Photo;
use App\Models\Review;
use App\Models\Selled;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\File as  Files;
use App\Models\FreelancerService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('type', 'customer')->get();
        return view('Admin.users.index', compact('users'));
    }



    public function allFreelancers()
    {
        $filter=[];
    
        $categories = Category::all();
                if(request()->cat_id && request()->subcat_id){
                    $freelancers = FreelancerService::where('parent_id', request()->cat_id )
                    ->where('service_id',request()->subcat_id)->get();
                    $freelancer_detail = collect();
                    foreach ($freelancers as $freelancer) {
                        $data = User::find($freelancer->freelancer_id);
                        $freelancer_detail->push($data);
                    }
              
        
                    if(request('freelancsearch')!=null){
        
                    if(in_array('highestrating',request('freelancsearch'))){
                        $freelancer_detail = $freelancer_detail->sortByDesc(function ($item){
                            
                            if($item->review()->count()>0){
                              return  $item->review()->sum('rate')/ $item->review()->count();
                            }else{
                               return  $item->review()->count();
                            }
                           
                        });
                        array_push($filter,'highestrating');
                    }
                    if(in_array('moreproject',request('freelancsearch'))){
                        $freelancer_detail = $freelancer_detail->sortBy(function ($item) {
                            return $item->request()->where('status','Completed')->count();
                        });
                        array_push($filter, 'moreproject');
                    
                    }
                   
        
                }else{
        
                   array_push($filter,'All');
                }
                $freelancers = $freelancer_detail->paginate(20);
                    return view('visitor.freelancers', ['freelancers'=>$freelancers, 'categories'=>$categories,'cat_id'=>request()->cat_id,'subcat_id'=>request()->subcat_id,'filter'=>$filter]);
        
                }elseif(request()->cat_id ){
                    $freelancers = FreelancerService::where('parent_id',null)
                    ->where('service_id',request()->cat_id)->get();
                    $freelancer_detail = collect();
                    foreach ($freelancers as $freelancer) {
                        $data = User::find($freelancer->freelancer_id);
                       $freelancer_detail->push($data);
                    }
              
                
                    if(request('freelancsearch')!=null){
    
                        if(in_array('highestrating',request('freelancsearch'))){
                            $freelancer_detail = $freelancer_detail->sortByDesc(function ($item){
                                
                                if($item->review()->count()>0){
                                  return  $item->review()->sum('rate')/ $item->review()->count();
                                }else{
                                   return  $item->review()->count();
                                }
                               
                            });
                            array_push($filter,'highestrating');
                        }
                        if(in_array('moreproject',request('freelancsearch'))){
                            $freelancer_detail = $freelancer_detail->sortByDesc(function ($item) {
                                return $item->request()->where('status','Completed')->count();
                            });
                            array_push($filter, 'moreproject');
                        
                        }
                       
                    }else{
                        array_push($filter,'All');
                    }
                   
                       
                        $freelancers =$freelancer_detail->paginate(20);
                    
                   
                    return view('visitor.freelancers', ['freelancers'=>$freelancers, 'categories'=>$categories,'cat_id'=>request()->cat_id,'filter'=>$filter]);
        
                }else{
                    $freelancers = User::where('type', 'freelancer')->get();
                    $categories = Category::all();
                    $filter = [];
                    
                    if (request('freelancsearch') != null) {
                    
                        if (in_array('highestrating', request('freelancsearch'))) {
                            $freelancers = $freelancers->sortByDesc(function ($item) {
                                if ($item->review()->count() > 0) {
                                    return $item->review()->sum('rate') / $item->review()->count();
                                } else {
                                    return $item->review()->count();
                                }
                            });
                            array_push($filter, 'highestrating');
                        }
                    
                        if (in_array('moreproject', request('freelancsearch'))) {
                            $freelancers = $freelancers->sortByDesc(function ($item) {
                                return $item->request()->where('status','Completed')->count();
                            });
                            array_push($filter, 'moreproject');
                        }
                    
                    } else {
                        array_push($filter, 'All');
                    }
                    $freelancers =  $freelancers->paginate(20);
                    
                    return view('visitor.freelancers', compact('freelancers', 'categories' ,'filter'));
                }
    }


    public function showFreelancerDetails(Request $request, $id)
    {
        $freelancer = User::find($id);
        $products = Product::where('freelancer_id' , $id)->get();
        $photos = Photo::where('freelancer_id' , $id)->get();
       $reviews=Review::where('freelancer_id',$id)->simplePaginate(10);
        return view('visitor.freelancer', compact('freelancer', 'products', 'photos','reviews'));
    }


   



    public function destroy(Request $request, $id)
    {
        User::find($id)->delete();
        session()->flash('Delete' , 'تم حذف المستخدم بنجاج');
        return back();
    }


    public function updateUserProfile(Request $request, $id)
    {
        $request->validate([
            'profile_image' => 'image',
            'name' => 'required|string',
            'phone' => ['required','min:10', \Illuminate\Validation\Rule::unique('users')->ignore(auth()->user()->id)],
            'email'=> ['required', 'string', 'email', 'max:255', \Illuminate\Validation\Rule::unique('users')->ignore(auth()->user()->id)],
        ]);

        $photo_name=User::findOrFail($id)->profile_image;
        if($request->hasFile('profile_image')){
            if($photo_name!="default.png"){
            File::delete('Admin3/assets/images/users/'.$photo_name);
            }
            $file_extention=$request->file('profile_image')->getCLientOriginalExtension();
            $photo_name=time(). ".".$file_extention;
            $request->file('profile_image')->move(public_path('Admin3/assets/images/users'),$photo_name);
        }

        User::find($id)->update([
            "name"=>$request->name,
            "phone"=>$request->phone,
            "email"=>$request->email,
            "profile_image"=>$photo_name,
        ]);

        return back();
    }


    public function updateFreelancerProfile(Request $request, $id)
    {
        $request->validate([
            'profile_image' => 'image',
            'name' => 'required|string',
            'phone' => ['required','min:10', \Illuminate\Validation\Rule::unique('users')->ignore(auth()->user()->id)],
            'email'=> ['required', 'string', 'email', 'max:255', \Illuminate\Validation\Rule::unique('users')->ignore(auth()->user()->id)],
            'bio' => 'required',
            'id_number' => ['required', \Illuminate\Validation\Rule::unique('users')->ignore(auth()->user()->id)],
            'business_register' => ['required', \Illuminate\Validation\Rule::unique('users')->ignore(auth()->user()->id)],
        ]);

        $photo_name=User::findOrFail($id)->profile_image;
        if($request->hasFile('profile_image')){
            if($photo_name!="default.png"){
                File::delete('Admin3/assets/images/users/'.$photo_name);
            }
            $file_extention=$request->file('profile_image')->getCLientOriginalExtension();
            $photo_name=time(). ".".$file_extention;
            $request->file('profile_image')->move(public_path('Admin3/assets/images/users'),$photo_name);
        }

        $user= User::find($id)->update([
            "name"=>$request->name,
            "phone"=>$request->phone,
            "email"=>$request->email,
            "profile_image"=>$photo_name,
            "id_number"=>$request->id_number,
            "bio"=>$request->bio,
            "business_register"=>$request->business_register,
        ]);
        return redirect()->back()->with("message","profile update sucessfully");
    }


    public function addorremovelikes($id)
    {
        $type=request("type");
        $flag=false;
        $action="append";
        if($type=="product"){
            $product =Product::findOrFail($id);
        if($product->likes->where("user_id",auth()->user()->id)->count()==0){
            $product->likes()->create([
                "user_id" => auth()->user()->id,
                "type"=> $type,
            ]);
            $action="add";
        }else{
            $product->likes()->where("user_id",auth()->user()->id)->delete();
            $action="delete";
            }

        $flag=true;

        }elseif($type=="photo"){
            $photo =Photo::findOrFail($id);
            if($photo->likes->where("user_id",auth()->user()->id)->count()==0){
                $photo->likes()->create([
                    "user_id" => auth()->user()->id,
                    "type"=> $type,
                ]);
                $action="add";
            }else{
                $photo->likes()->where("user_id",auth()->user()->id)->delete();
                $action="delete";
                }
            $flag=true;
            }
        return json_encode(["status"=>$flag,"action"=>$action],true);
    }

    public function addcart($id){


    }


    public function getprofile(){

        $user_id=auth()->user()->id;
        $user=User::find($user_id);

        $currentYear = Carbon::now()->year; 
        $currentMonth = Carbon::now()->month;
        $lastMonth = Carbon::now()->subMonth()->month;

        
      $fc=Selled::where('user_id',$user_id)->whereMonth('created_at', $currentMonth)
        ->whereYear('created_at', $currentYear)->get();
        $files_current=[];
        foreach($fc as $f){
            $files_current[]=$f->selledsable()->withTrashed()->first()->file()->first();
   
        }
      
        // $files_current= Files::where('user_id', $user_id)->whereMonth('created_at', $currentMonth)
        // ->whereYear('created_at', $currentYear)
        // ->get();
        $files_lastmonth=[];
        $fl=Selled::where('user_id',$user_id)->whereMonth('created_at', $lastMonth)
        ->whereYear('created_at', $currentYear)
        ->get();
        foreach($fl as $f){
            $files_lastmonth[]=$f->selledsable()->withTrashed()->first()->file()->first();

        }
        // $files_lastmonth= Files::where('user_id', $user_id)->whereMonth('created_at', $lastMonth)
        // ->whereYear('created_at', $currentYear)
        // ->get();


        $f0=Selled::where('user_id',$user_id)->whereNotBetween('created_at', [
                Carbon::createFromDate($currentYear, $lastMonth,1),
                Carbon::createFromDate($currentYear, $currentMonth,31)
            ])->get();
            $files_old=[];
        foreach($f0 as $f){
            $files_old[]=$f->selledsable()->withTrashed()->first()->file()->first();

        }
        // $files_old=Files::where('user_id',$user_id)->whereNotBetween('created_at', [
        //     Carbon::createFromDate($currentYear, $lastMonth,1),
        //     Carbon::createFromDate($currentYear, $currentMonth,31)
            
        // ])
        // ->get();



        $wallet_history=Payment::all();
        $user_wallet_hestory=[];
        foreach($wallet_history as $wr){

     if($wr->user_id == $user_id){

               array_push( $user_wallet_hestory,$wr);

    }

     if($wr->freelancer_id == $user_id && ($wr->status=="purchase")){
      
        array_push($user_wallet_hestory,$wr);
    }

        }
      
return view('user.userprofile',compact('user','files_current','files_lastmonth','files_old','user_wallet_hestory'));

    }


    function freelancerwallet(){

        $user_id=auth()->user()->id;
        $user=  User::findorfail(auth()->user()->id);
        $total_wallet=$user->wallet->total;

        $wallet_history=Payment::all();
        $user_wallet_hestory=[];
        foreach($wallet_history as $wr){

     if($wr->user_id == $user_id){

               array_push( $user_wallet_hestory,$wr);

    }

     if($wr->freelancer_id == $user_id && ($wr->status=="purchase")){
      
        array_push( $user_wallet_hestory,$wr);
    }

        

        }


        // dd($user_wallet_hestory);

       return  view("freelancer.wallet",compact('total_wallet','user_wallet_hestory'));
     
     

    }



    public function switchToFreelancer(Request $request){
        $user_id=auth()->user()->id;
        $request->validate([
            'id_number' => ['required ','digits:10'],
            'business_register' => ['required ','numeric'],
        ]
    );

   
        $user = User::find($user_id);
        if($user->type == 'customer'){
            $user->update([
                'id_number' => $request->id_number,
                'business_register' => $request->business_register,
                'type' => 'freelancer',
            ]);
        }
toastr()->success('switch successfully');
return redirect()->route('freelanc.profile');
}



}
