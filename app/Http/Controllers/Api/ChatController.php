<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Events\ChatMessage;
use App\Models\chat; 
use App\Models\User; 
use App\Models\Requests;
use App\Models\Reservation;
use App\Http\Controllers\Api\ApiResponseTrait;

class ChatController extends Controller
{
    use ApiResponseTrait;

    public function message(Request $request)
    {
        return [];
    }
    
    public function getMessages(Request  $request){
        
        try{
        $type=$request->type;
        $messageto=$request->messageto;
        $request_id=$request->request_id;
        $user=auth('api')->user()->id;
        
        if($type=='request'){
        $req= Requests::findorfail($request_id);
       
         $messages=$req->chats
         ->where(function ($q)use($messageto,$user) {return $q->where('from',$user)->orWhere('from',$messageto);})
        ->where(function ($q)use($messageto,$user) {return $q->where('to',$messageto)->orWhere('to',$user);})->sortBy('created_at');


        // if( count($messages) > 0 ){
        
        // }else{
        
        // }
   
        }elseif($type=='reservation'){
            $req= Reservation::findorfail($request_id);
            $messages=$req->chats
            ->where(function ($q)use($messageto,$user) {return $q->where('from',$user)->orWhere('from',$messageto);})
           ->where(function ($q)use($messageto,$user) {return $q->where('to',$messageto)->orWhere('to',$user);})->sortBy('created_at');
   
        //   if( count($messages)>0 ){
       
   
        //   }else{
              
  
        //   }
  
        }
        
           $to=User::findorfail($messageto);
           $to->profile_image=asset('Admin3/assets/images/users/'.$to->profile_image);
     
        return $this->returnData(200,"message get successfully " ,compact('messages','to'));
        }catch(\Exception $e){
        echo $e;
       return $this->returnError('500', 'get message Failed');
        }     
    }



    public function sendMessage(Request $request){

        try{
            $msg=null;
            $type=$request->type;
            $messageto=$request->to;
            $request_id=$request->request_id;
            $user=auth('api')->user()->id;
            
             
        if($request->type=="request"){

            $order= Requests::findorfail($request->request_id);
            $msg = $order->chats()->create([
              'text'=>$request->message,
              'type'=>trim($request->type),
              'from'=>$user,
              'to'=>$request->to,
            ]);

        }elseif($request->type=="reservation"){
            $order= Reservation::findorfail($request->request_id);
            $msg = $order->chats()->create([
              'text'=>$request->message,
              'type'=>trim($request->type),
              'from'=>$user,
              'to'=>$request->to,
            ]);
        }

        event(new ChatMessage($msg,$request->request_id));
      
          return $this->returnData(200,"message send successfully " );
 
            }catch(\Exception $e){
            echo $e;
           return $this->returnError('500', 'get message Failed');
            }     
    }
}
