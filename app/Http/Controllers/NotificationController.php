<?php

namespace App\Http\Controllers;

use App\Models\User;
use  App\Notifications\Test;
// use Kreait\Firebase\Factory;
// use Kreait\Firebase\Messaging\CloudMessage;
// use Kreait\Firebase\Messaging\Notification;
use Illuminate\Http\Request;
use Kutia\Larafirebase\Facades\Larafirebase;
use Illuminate\Support\Facades\Notification as Notifi;

class NotificationController extends Controller
{
    //

    public function index()
    {
        $notifications = Notification::all();
        return response()->json($notifications);
    }

public function create(Request $request)
{
    // Validate the request data
    // $request->validate([
    //     'title' => 'required|string',
    //     'body' => 'required|string',
    // ]);

    // Create a new notification in the database
    
    $user=User::all();

    //  Notifi::send($user,new Test('hello world',"ahmed"));
   

     $SERVER_API_KEY = env('FCM_SERVER_KEY');
    //  $firebaseToken=User::whereNotNull('device_token')->pluck('device_token')->all();
     $firebaseToken=User::whereNotNull('device_token')->pluck('device_token')->all();
     $registrationToken = 'your-registration-token';
 

 
    try{
        $fcmTokens =User::whereNotNull('device_token')->pluck('device_token')->toArray();

    

        $ss=  Larafirebase::withTitle($request->title)
            ->withBody($request->body)
            ->sendMessage($fcmTokens);

        return redirect()->back()->with('success','Notification Sent Successfully!!');

    }catch(\Exception $e){
        report($e);
        return redirect()->back()->with('error','Something goes wrong while sending notification.');
    }

 }

  
 public function storeToken(Request $request)
 {
     auth()->user()->update(['device_token'=>$request->token]);
     return response()->json(['Token successfully stored.']);
 }
}
