<?php
namespace App\Http\Controllers\Api;
use App\Models\Requests;
use App\Models\User;
use App\Models\File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Api\ApiResponseTrait;

class OrderController extends Controller
{
    use ApiResponseTrait;
    
    
    
  public function getPublicRequests($freelancer_id){
      
       try{
            
            $price=null;
            
            $requests = Requests::where('type', 'public')->where('status','Pending')->orderBy('status')->with(['user', 'freelancer', 'category', 'service', 'file', 'offer'])->get();
            
            
            foreach($requests as $request){
            $request['attachment'] = asset('front/upload/files/'.$request->file()->first()->url);
            
              if(!strpos($request->user->profile_image, "Admin3/assets/images/users/")){
                $request->user->profile_image = asset('Admin3/assets/images/users/'.$request->user->profile_image);
              }
              
              if($request->freelancer !=null){
              if(!strpos($request->freelancer->profile_image, "Admin3/assets/images/users/")){
                $request->freelancer->profile_image = asset('Admin3/assets/images/users/'.$request->freelancer->profile_image);
            
              }
                 
              }
                   foreach($request['offer'] as $offer){
                  
                  
                    $offer['freelancer']= User::find($offer->freelancer_id);
                    
                    if(!strpos($offer['freelancer']->profile_image,'Admin3/assets/images/users/')){
                        
                        $offer['freelancer']->profile_image= asset('Admin3/assets/images/users/'. $offer['freelancer']->profile_image);
                    }
                    
            }
                   
                   if($request->freelancer_id !=null){
                       
                       $request->price= $request->offer()->where('freelancer_id',$request->freelancer_id)->first()->price ;
                   }else{
                       
                        $request->price=null;
                   }
                     
                 if($request->type =='public' && $request->status =='Pending' && $request->offer->where('freelancer_id',$freelancer_id)->first()!=null){
                     
                     $del=false;
                if($request->type =='public' && $request->status =='Pending' && in_array($request->offer->where('freelancer_id',$freelancer_id)->first()->status,['accept','pending'])){
                   
                   $del=true;
                }
                  
                if($request->blacklist()->exists() && $freelancer_id==$request->blacklist()->where('freelancer_id',$freelancer_id)->first()->freelancer_id){
                        $del=true;
                    

                }
                
                if($del){
                     
                  $requests->forget($request);
                  $del=false;
                }
                
                        } 
                   
            
            }
           
            return $this->returnData(200, 'Requests Returned Successfully', $requests);
        }catch(\Exception $e){
            echo $e;
            return $this->returnError(400, 'Requests Returned Failed');
        }
      
      
  }
  
  
  public function getPrivateRequests($freelancer_id){
      
        try{
            
            $price=null;
            
            $requests = Requests::where('type', 'private')->where('freelancer_id',$freelancer_id)->where('status','Pending')->orderBy('status')->with(['user', 'freelancer', 'category', 'service', 'file', 'offer'])->get();
            
            foreach($requests as $request){
            $request['attachment'] = asset('front/upload/files/'.$request->file()->first()->url);
            
              if(!strpos($request->user->profile_image, "Admin3/assets/images/users/")){
                $request->user->profile_image = asset('Admin3/assets/images/users/'.$request->user->profile_image);
              }
              
              if($request->freelancer !=null){
              if(!strpos($request->freelancer->profile_image, "Admin3/assets/images/users/")){
                $request->freelancer->profile_image = asset('Admin3/assets/images/users/'.$request->freelancer->profile_image);
            
              }
              
                           
              
              }

          
            
                   foreach($request['offer'] as $offer){
                  
                  
                    $offer['freelancer']= User::find($offer->freelancer_id);
                    
                    if(!strpos($offer['freelancer']->profile_image,'Admin3/assets/images/users/')){
                        
                        $offer['freelancer']->profile_image= asset('Admin3/assets/images/users/'. $offer['freelancer']->profile_image);
                    }
                    
                    
           
            }
                   
                   if($request->freelancer_id !=null && $request->offer()->where('freelancer_id',$request->freelancer_id)->first()){
                       $request->price= $request->offer()->where('freelancer_id',$request->freelancer_id)->first()->price ;
                   }else{
                       
                        $request->price=null;
                   }
                   
                   
                      if($request->type =='private' && $request->status =='Pending' && $request->offer->where('freelancer_id',$freelancer_id)->first()!=null){
                         if($request->type =='private' && $request->status =='Pending' && in_array($request->offer->where('freelancer_id',$freelancer_id)->first()->status,['accept','pending'])){
                    
                  $requests->forget($key);

                }
               } 
            
            }
           
            return $this->returnData(200, 'Requests Returned Successfully', $requests);
        }catch(\Exception $e){
            echo $e;
            return $this->returnError(400, 'Requests Returned Failed');
        }
  }
    
}