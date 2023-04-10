<?php
namespace App\Http\Controllers\Api;
use App\Models\Requests;
use App\Models\User;
use App\Models\File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Api\ApiResponseTrait;

class RequestController extends Controller
{
    use ApiResponseTrait;


    public function publicRequests(Request $request)
    {
        try{
            
            $requests = Requests::where('type', 'public')->orderBy('status')->with(['user', 'freelancer', 'category', 'service', 'file'])->get();
            
            foreach($requests as $request){
            $request['attachment'] = asset('front/upload/files/'.$request->file()->first()->url);
            
              if(!stripos($request->user->profile_image, "Admin3/assets/images/users/")){
                $request->user->profile_image = asset('Admin3/assets/images/users/'.$request->user->profile_image);
              }

              if($request->offer()->exists()){
                // $request['price'] = $request->offer->where('freelancer_id', $request->freelancer_id)->first()->price;
              }
              else{
                 $request['price'] = null; 
              }
            }
            if($request->freelancer_id){
                    $request->freelancer->profile_image = asset('Admin3/assets/images/users/'.$request->freelancer->profile_image);
                }
            return $this->returnData(200, 'Requests Returned Successfully', $requests);
        }catch(\Exception $e){
            echo $e;
            return $this->returnError(400, 'Requests Returned Failed');
        }
    }




    public function privateRequests(Request $request)
    {
        try{
            $requests = Requests::where('type', 'private')->orderBy('status')->with(['user','freelancer', 'category', 'service', 'file'])->get();
            
            foreach($requests as $request){
                 $request['attachment'] = asset('front/upload/files/'.$request->file()->first()->url);
              if(!stripos($request->user->profile_image, "Admin3/assets/images/users/")){
                $request->user->profile_image = asset('Admin3/assets/images/users/'.$request->user->profile_image);
              }
            }
            
          if($request->freelancer_id){
                $request->freelancer->profile_image = asset('Admin3/assets/images/users/'.$request->freelancer->profile_image);
            }

            return $this->returnData(200, 'Requests Returned Successfully', $requests);
        }catch(\Exception $e){
            echo $e;
            return $this->returnError(400, 'Requests Returned Failed');
        }
    }






    public function createRequest(Request $request)
    {
        try{
            
            
            $this->validate($request, [
                'category_id' => 'required',
                'service_id' => 'required',
                'title' => 'required|string',
                'description' => 'required',
                'attachment' => 'required',
                'due_date' => 'required',
                'type' => [\Illuminate\Validation\Rule::in(['public', 'private'])]
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
            $re = Requests::create([
                'random_id' => $random_id,
                'title'=> $request->title,
                'category_id' => $request->category_id,
                'service_id' => $request->service_id,
                'description' => $request->description,
                'due_date' => $request->due_date,
                'user_id' =>  auth()->guard('api')->user()->id,
                'type' => 'public',
            ]);
 
        }elseif($request->type == 'private'){
            if($request->freelancer_id == null){
                return $this->returnError(400, "Freelancer_id Doesn't Exists");
            }
            $re = Requests::create([
                'random_id' => $random_id,
                'title' => $request->title,
                'category_id' => $request->category_id,
                'service_id' => $request->service_id,
                'description' => $request->description,
                'due_date' => $request->due_date,
                'user_id' =>  auth()->guard('api')->user()->id,
                'freelancer_id' => $request->freelancer_id,
                'type' => 'private',
            ]);
        }

        $name = explode(".", $request->file("attachment")->getCLientOriginalName())[0];
        $size = number_format($request->file("attachment")->getSize()/ 1024,2);
        $type = $request->file("attachment")->getCLientOriginalExtension();
        $file_extension = $request->file("attachment")->getCLientOriginalExtension();
        $attachment_name = time(). ".".$file_extension;
        $request->file("attachment")->move(public_path('front/upload/files/'), $attachment_name);

        $re->file()->create([
            'name'=> $name,
            'user_id' => auth('api')->user()->id,
            'type' => $type,
            'url' => $attachment_name,
            'size' => $size,
        ]);
            return $this->returnData(201, 'Request Created Successfully', $re);
        }catch(\Exception $e){
            echo $e;
            return $this->returnError(400, 'Request Created Failed');
        }
    }





    public function getPublicRequestById($id)
    {
        try{
            $requests = Requests::find($id);
            if($requests->type == 'public'){
                return $this->returnData(200, 'Request Returned Successfully', $requests);
            }else{
                return $this->returnError(404, 'Request Not Found');
            }
        }catch(\Exception $e){
            echo $e;
            return $this->returnError(400, 'Request Returned Failed');
        }
    }




    public function getPrivateRequestById(Request $request, $id)
    {
        try{
            $request = Requests::find($id);
            if($request->type == 'private'){
                return $this->returnData(200, 'Request Returned Successfully', $request);
            }else{
                return $this->returnError(404, 'Request Not Found');
            }
        }catch(\Exception $e){
            echo $e;
            return $this->returnError(400, 'Request Returned Failed');
        }
    }
    
    
    
    
    
    public function changeStatus($id)
    {
        try{
            $request = Requests::find($id);
            if($request){
                if($request['status'] === 'Pending'){
                    Requests::where('id' , $id)->update(['status' => 'In Process']);
                }
                if($request['status'] === 'In Process'){
                    Requests::where('id' , $id)->update(['status' => 'Finished']);
                }
                if($request['status'] === 'Finished'){
                    Requests::where('id' , $id)->update(['status' => 'Completed']);
                }
                $request = Requests::find($id);
                return $this->returnData(200, 'Request Status Changed Successfully', $request);
            }else{
                return $this->returnError(400, "Request Doesn't Exists");
            }
        }catch(\Exception $e){
            echo $e;
            return $this->returnError(400, 'Request Returned Failed');
        }
    }
    
    
    
    
    
    
    public function cancelRequest($id)
    {
        $request = Requests::find($id);
         if($request->payment()->where('freelancer_id', $request->freelancer_id)->first()){
        
            $total_pay = $request->payment()->where('freelancer_id', $request->freelancer_id)->first()->total;
            $edit_pay = $request->payment()->where('freelancer_id', $request->freelancer_id)->first()->update([
                'status'=>"refund"
            ]);

           $current_wallet = User::findOrFail(auth()->user()->id)->wallet->total;
            $current_wallet += $total_pay;
            $edit_offer = Requests::findorfail($id)->offer()->where('freelancer_id', $request->freelancer_id)->update([
                "status"=>'reject',
            ]);
        }
        $edit_request = $request->update(['status'=>"Cancel by customer"]);
        return redirect()->back()->with(['state'=>"cancel", "id"=>$id]);
    }
}
