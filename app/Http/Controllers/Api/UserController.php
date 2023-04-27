<?php
namespace App\Http\Controllers\Api;
use App\Models\User;
use App\Models\File;
use App\Models\Product;
use App\Models\Photo;
use App\Models\Selled;
use Carbon\Carbon;
use App\Models\Category;
use App\Models\Service;
use App\Models\FreelancerService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

use App\Http\Controllers\Api\ApiResponseTrait;

class UserController extends Controller
{
    use ApiResponseTrait;


    public function switchToFreelancerAccount(Request $request, $user_id)
    {
        try {
            $request->validate([
                'id_number' => 'required',
                'business_register' => 'required',
            ]);

            $user = User::find($user_id);
            if($user->type == 'customer'){
                $user->update([
                    'id_number' => $request->id_number,
                    'business_register' => $request->business_register,
                    'type' => 'freelancer',
                ]);
            }
            return $this->returnData(200, 'User Switched Successfully', $user);
        }catch(\Exception $e){
            echo $e;
            return $this->returnError('500', 'User Switched Failed');
        }
    }






    public function allFreelancers($id=null)
    {
        try{

            if($id){
                $freelancers = User::where('type', 'freelancer')->where('id','!=',$id)->get();
            }else{
                $freelancers = User::where('type', 'freelancer')->get();
            }
           
            foreach ($freelancers as $freelancer){
                $freelancer->profile_image = asset('Admin3/assets/images/users/'.$freelancer->profile_image);
            }
            return $this->returnData(200, 'Freelancers Returned Successfully', $freelancers);
        }catch(\Exception $e){
            echo $e;
            return $this->returnError(400, 'Freelancers Returned Failed');
        }
    }



    // $freelancer['product'] = Product::with(['freelancer', 'category', 'service', 'likes'])->get();
    // foreach ($freelancer['product'] as $product){
    //     $product->attachment = asset('front/upload/fils/'.$product->attachment);
    //     $product->img1 = asset('assets/images/product/'.$product->img1);
    //     $product->img2 = asset('assets/images/product/'.$product->img2);
    //     $product->img3 = asset('assets/images/product/'.$product->img3);
    // }



    public function getFreelancerById(Request $request, $id)
    {
        try{
            $freelancer_service=[];
            $freelancer = User::where('type', 'freelancer')->with('review')->find($id);
          
           
            $freelancer->profile_image = asset('Admin3/assets/images/users/'.$freelancer->profile_image);
            
            $freelancer['product'] = Product::where('freelancer_id', $id)->get();
            foreach ($freelancer['product'] as $product){
                $product->attachment = asset('front/upload/fils/'.$product->attachment);
                $product->img1 = asset('assets/images/product/'.$product->img1);
                $product->img2 = asset('assets/images/product/'.$product->img2);
                $product->img3 = asset('assets/images/product/'.$product->img3);
                $product['likes'] = $product->likes()->count();
            }
            
            $freelancer['photo'] = Photo::where('freelancer_id', $id)->get();
            foreach ($freelancer['photo'] as $photo){
                $photo->photo = asset('assets/images/photo/'.$photo->photo);
            }
    
           
            $freelanc_service = FreelancerService::where('freelancer_id',$id)->get();
            $freelancer_service = [];
            foreach($freelanc_service as $serv){
               if($serv->parent_id == null){
       
                $cate= Category::where('id',$serv->service_id)->select('id' ,'title_en as service_en','title_ar as service_ar','icon as service_icon','created_at','updated_at')->first();
               
                $cate->category_id=null;
                $freelancer_service[]= $cate;
               }else{
                $freelancer_service[] = Service::find($serv->service_id);
               }
            }
            
            $freelancer['freelancer_service']=$freelancer_service;

            if(!$freelancer || $freelancer->type != 'freelancer'){
                return $this->returnError('404', 'Freelancer Not Found');
            }
            return $this->returnData(200, 'Freelancer Returned Successfully', $freelancer);
        }catch(\Exception $e){
            echo $e;
            return $this->returnError(400, 'Freelancer Returned Failed');
        }
    }






    public function editFreelancer(Request $request, $id)
    {
        try{
            $request->validate([
                'name' => 'required',
                'email' => 'required|email',
                'phone' => 'required',
                'profile_image' => 'nullable',
                'bio' => 'required',
                'id_number' => 'required',
                'business_register' => 'required',
            ]);

            $freelancer = User::find($id);
            if(!$freelancer->id || $freelancer->type != 'freelancer'){
                return $this->returnError(400, "Doesn't a Freelancer");
            }
            
            if(!$request->profile_image == null){
                $freelancer['profile_image'] = asset('Admin3/assets/images/users/'.$freelancer->profile_image);
                $file_extension = $request->file("profile_image")->getCLientOriginalExtension();
                $photo_name = time(). "." .$file_extension;
                $request->file("profile_image")->move(public_path('Admin3/assets/images/users/'), $photo_name);

                $freelancer->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'profile_image' => $photo_name,
                    'bio' =>  $request->bio,
                    'id_number' => $request->id_number,
                    'business_register' => $request->business_register,
                ]);
            }else{      
                $freelancer->update([  
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'bio' =>  $request->bio,
                    'id_number' => $request->id_number,
                    'business_register' => $request->business_register,
                ]);
            }
            
            $freelancer->profile_image = asset('Admin3/assets/images/users/'.$freelancer->profile_image );
            return $this->returnData(200, 'Freelancer Updated Successfully', $freelancer);
        }catch(\Exception $e){
            echo $e;
            return $this->returnError(400, 'Freelancer Updated Failed');
        }
    }
    
    
    
    
    
    public function getfreelancerServices(Request $request, $freelancer_id)
    {
        try{
            $freelancer = User::find($freelancer_id);
            $services = FreelancerService::where('freelancer_id', $freelancer_id)->get();
            if($freelancer->type != 'freelancer'){
                return $this->returnError(404, "Freelancer Doesn't Exists");
            }
        }catch(\Exception $e){
            return $this->returnError(400, 'Freelancer Updated Failed');
        }
        return $this->returnData(200, 'Services Returned Successfully', $services);
    }





    public function editCustomer(Request $request, $id)
    {
        try{                
            $request->validate([
                'name' => 'required',
                'email' => 'required',
                'phone' => 'required',
                'profile_image' => 'nullable',
            ]);

            $customer = User::find($id);
            if(!$customer->id || $customer->type != 'customer'){
                return $this->returnError(404, "Doesn't a Customer");
            }
            
            if(!$request->profile_image == null){
                // $customer['profile_image'] = asset('Admin3/assets/images/users/'.$customer->profile_image);
            $file_extension = $request->file("profile_image")->getCLientOriginalExtension();
            $photo_name = time(). "." .$file_extension;
            $request->file("profile_image")->move(public_path('Admin3/assets/images/users/'), $photo_name);

                 $customer->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'profile_image' => $photo_name,
                ]);
            }else{      
                $customer->update([  
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                ]);
            }
            $customer->profile_image=asset('Admin3/assets/images/users/'.$customer->profile_image);
           
            return $this->returnData(200, 'Customer Updated Successfully', $customer);
        }catch(\Exception $e){
            echo $e;
            return $this->returnError(400, 'Customer Updated Failed');
        }
    }







    public function getCustomerById(Request $request, $id)
    {
        try{
            $user = User::find($id);
            $user->profile_image = asset('Admin3/assets/images/users/'.$user->profile_image);
            if(!$user || $user->type != 'customer'){
                return $this->returnError('404', 'Customer Not Found');
            }
            return $this->returnData(200, 'Customer Returned Successfully', $user);
        }catch(\Exception $e){
            echo $e;
            return $this->returnError(400, 'Customer Returned Failed');
        }
    }




    
    public function allFiles(Request $request,$id)
    {
        try{
         
        $user_id=$id;
        $user=User::find($user_id);

        $currentYear = Carbon::now()->year; 
        $currentMonth = Carbon::now()->month;
        $lastMonth = Carbon::now()->subMonth()->month;

        
      $fc=Selled::where('user_id',$user_id)->whereMonth('created_at', $currentMonth)
        ->whereYear('created_at', $currentYear)->get();
        $files_current=[];
        foreach($fc as $f){
              foreach($f->file()->get() as $file){
                $file->url = asset('front/upload/files/'.$file->url);
                $files_current[]=$file;
              }
              
        }
      
        $files_lastmonth=[];
        $fl=Selled::where('user_id',$user_id)->whereMonth('created_at', $lastMonth)
        ->whereYear('created_at', $currentYear)
        ->get();
        foreach($fl as $f){
          foreach($f->file()->get() as $file){
            $file->url = asset('front/upload/files/'.$file->url);
            $files_lastmonth[]=$file;
          }
          
        }
   
        $f0=Selled::where('user_id',$user_id)->whereNotBetween('created_at', [
                Carbon::createFromDate($currentYear, $lastMonth,1),
                Carbon::createFromDate($currentYear, $currentMonth,31)
            ])->get();
            $files_old=[];
        foreach($f0 as $f){
            foreach($f->file()->get() as $file){
                $file->url = asset('front/upload/files/'.$file->url);
                $files_old[]=$file;
              }
        }

          return $this->returnData(200, 'Files Returned Successfully', compact('files_current','files_lastmonth','files_old'));
        }catch(\Exception $e){
            echo $e;
            return $this->returnError(400, 'Files Returned Failed');
        }
    }
    
    function deleteFile($id){
        
         try{
          if(File::find($id)->user_id==auth('api')->user()->id){
            $d=File::destroy($id);
            return $this->returnData(200, 'Files deleted Successfully');
          }else{
            return $this->returnError(404, 'Files Not Found');
          }
           
            
       
     }catch(\Exception $e){
            echo $e;
            return $this->returnError(400, 'Files Returned Failed');
        }
    }
    



    public function getWallet(){
        try{
            $user_id=auth('api')->user()->id;
                $user=  User::findorfail($user_id);
                $total_wallet=$user->wallet->total;
                return $this->returnData(200, 'wallet returned  Successfully', $total_wallet);
                
           
         }catch(\Exception $e){
                echo $e;
                return $this->returnError(400, 'wallet returned Failed');
            }
    }
    

    public function getWalletHistory(){
        
        try{

            $wallet_history=Payment::all()->sortByDesc("created_at");
        $user_wallet_hestory=[];
        $user_id=auth('api')->user()->id;
        foreach($wallet_history as $wr){

     if($wr->user_id == $user_id){

               array_push( $user_wallet_hestory,$wr);

    }

     if($wr->freelancer_id == $user_id && ($wr->status=="purchase")){
      
        array_push($user_wallet_hestory,$wr);
    }

        }
        return $this->returnData(200, 'wallet returned  Successfully', $user_wallet_hestory);
                
        }catch(\Exception $e){
            echo $e;
            return $this->returnError(400, 'wallet returned Failed');
        }
        
    }

}