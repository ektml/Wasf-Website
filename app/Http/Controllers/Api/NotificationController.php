<?php
namespace App\Http\Controllers\Api;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Kutia\Larafirebase\Facades\Larafirebase;
use Illuminate\Support\Facades\Notification as Notifi;

class NotificationController extends Controller
{
    public function createNotification(Request $request)
    {
        // Validate the request data
        // $request->validate([
        //     'title' => 'required|string',
        //     'body' => 'required|string',
        // ]);
        $user = User::all();
    
        //  Notifi::send($user,new Test('hello world',"ahmed"));

         $SERVER_API_KEY = env('FCM_SERVER_KEY');
         $firebaseToken = User::whereNotNull('device_token')->pluck('device_token')->all();
         $registrationToken = 'your-registration-token';

        try{
            $fcmTokens = User::whereNotNull('device_token')->pluck('device_token')->toArray();
            $ss = Larafirebase::withTitle($request->title)
                ->withBody($request->body)
                ->sendMessage($fcmTokens);
            return redirect()->back()->with('success','Notification Sent Successfully!!');
        }catch(\Exception $e){
            report($e);
            return redirect()->back()->with('error','Something goes wrong while sending notification.');
        }
     }
     
     
     
     
     
    public function getNotifications()
    {
      $notifications = auth()->User()->notifications;
      auth()->User()->unreadNotifications->markAsRead();
      return view('user.notification', compact('notifications'));
    }





    public function getCount()
    {
        $count = auth()->user()->unreadNotifications->count();
        if($count > request()->count){
            toastr()->info('new notification');
            return JSON_encode(['status'=>true,'count'=>$count]);
        }else{
            return JSON_encode(['status'=>false]);
        }
    }
    
    

      
     public function storeToken(Request $request)
     {
         auth()->user()->update(['device_token'=>$request->token]);
         return response()->json(['Token successfully stored.']);
     }
}
