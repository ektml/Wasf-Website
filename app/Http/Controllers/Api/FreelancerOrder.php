<?php
namespace App\Http\Controllers\Api;
use App\Models\User;
use App\Models\Offer;
use App\Models\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\ApiResponseTrait;

class FreelancerOrder extends Controller
{
    use ApiResponseTrait;
    
    public function getPublicRequests(Request $request, $freelancer_id)
    {
        try{
            $freelancer = User::find($freelancer_id);
            if($freelancer->type != 'freelancer'){
                return $this->returnError(404, "Freelancer Doesn't Exists");
            }
            
            $requests = Requests::where('type', 'public')->where('status', 'Pending')->with(['user', 'freelancer', 'category', 'service', 'file'])->get();

            if($freelancer_id == auth('api')->user()->id){
                foreach($requests as $request){
                $request['attachment'] = asset('front/upload/files/'.$request->file()->first()->url);
                
                $offers = Offer::where('freelancer_id', '!=', $freelancer_id)->where('type', 'request')->
                where('offersable_id', $request->id)->where('status', 'pending')->get();
                $request['offers'] = $offers;
                
                  if(!stripos($request->user->profile_image, "Admin3/assets/images/users/")){
                    $request->user->profile_image = asset('Admin3/assets/images/users/'.$request->user->profile_image);
                  }
                }
                }else{
                    return $this->returnError(403, 'UnAuthenticated');
                }
                if($request->freelancer_id){
                    $request->freelancer->profile_image = asset('Admin3/assets/images/users/'.$request->freelancer->profile_image);
            }
            return $this->returnData(200, 'Public Requests Returned Successfully', $requests);
        }catch(\Exception $e){
            echo $e;
            return $this->returnError(400, 'Public Requests Returned Failed');
        }
    }





    public function getPrivateRequests($freelancer_id)
    {
        try{
            $freelancer = User::find($freelancer_id);
            if($freelancer->type != 'freelancer'){
                return $this->returnError(404, "Freelancer Doesn't Exists");
            }

            if($freelancer_id == auth('api')->user()->id){
            $requests = Requests::where('freelancer_id', $freelancer_id)->where('type', 'private')->where('status', 'Pending')
            ->with(['user', 'freelancer', 'category', 'service', 'file'])->get();
            
            foreach($requests as $request){
                $request['attachment'] = asset('front/upload/files/'.$request->file()->first()->url);
            
              if(!stripos($request->user->profile_image, "Admin3/assets/images/users/")){
                $request->user->profile_image = asset('Admin3/assets/images/users/'.$request->user->profile_image);
              }
    
                if(!stripos($request->freelancer->profile_image, "Admin3/assets/images/users/")){
                $request->freelancer->profile_image = asset('Admin3/assets/images/users/'.$request->freelancer->profile_image);
              }
              
              if($request->offer()->exists()){
                $request['price'] = $request->offer->where('freelancer_id', $request->freelancer_id)->first()->price;
              }
            }
                return $this->returnData(200, 'Private Requests Returned Successfully', $requests);
            }else{
                return $this->returnError(403, 'UnAuthenticated');
            }
        }catch(\Exception $e){
            echo $e;
            return $this->returnError(400, 'Private Requests Returned Failed');
        }
    }








    public function getMyWork(Request $request, $freelancer_id)
    {
        try{
            $freelancer = User::find($freelancer_id);
            if($freelancer->type != 'freelancer'){
                return $this->returnError(404, "Doesn't a Freelancer");
            }

            $ignor=['Cancel by Customer'];
            if($freelancer_id == auth('api')->user()->id){
                $privates = Requests::with('user', 'freelancer','category', 'service', 'offer', 'file')->where(function($q)use($freelancer_id){
                $q->where('freelancer_id', $freelancer_id)->orWhere('freelancer_id',null);
                })->whereNotIn('status',$ignor)->orderBy('status')->get();

                $result = [];
                foreach($privates as $p){
                    $p['attachment'] = asset('front/upload/files/'.$p->file()->first()->url);


                    if($p->status =='Pending' && $p->offer->where('freelancer_id', $freelancer_id)->first() == null){
                       
                        continue;
                    }elseif( $p->status =='Pending' && in_array($p->offer->where('freelancer_id', $freelancer_id)->first()->status,['reject'])){
                    continue;
                }
                if(!strpos($p->user->profile_image, "Admin3/assets/images/users/")){
                    $p->user->profile_image = asset('Admin3/assets/images/users/'.$p->user->profile_image);
                  }
                array_push($result, $p);
            }
                return $this->returnData(200,'My Work Of Requests Returned Successfully', $result);
            }else{
                return $this->returnError(403,'UnAuthenticated');
            }
        }catch(\Exception $e){
            echo $e;
            return $this->returnError(400, 'My Work Of Requests Returned Failed');
        }
    }
    
}
