<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationPageController extends Controller
{
    public function getNotification(){
      $notifications = auth()->user()->notifications;
      auth()->User()->unreadNotifications->markAsRead();

      return view('user.notification',compact('notifications'));
      
    }

    
    public function getCount(){
        $count=auth()->user()->unreadNotifications->count();

       
        if($count > request()->count){
        
            return JSON_encode(['status'=>true,'count'=>$count]);
        }else{
            return JSON_encode(['status'=>false]);
        }
      
    }
}
