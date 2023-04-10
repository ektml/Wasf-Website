<?php

namespace App\Http\Controllers;

use App\Models\chat;
use App\Models\Requests;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $type=request('type');
        $messageto=request('messageto');
        $request_id=request('request_id');
        $user=auth()->user()->id;
        if($type=='request'){

        $request= Requests::findorfail($request_id);
         $messages=$request->chats
         ->where(function ($q)use($messageto,$user) {return $q->where('from',$user)->orWhere('from',$messageto);})
        ->where(function ($q)use($messageto,$user) {return $q->where('to',$messageto)->orWhere('to',$user);})->sortBy('created_at');

        if( count($messages)>0 ){
            $messagelist=array('message'=>$messages, 'status'=>'found message');
            return JSON_encode($messagelist);

        }else{
            if(app()->getLocale()=='ar'){
                $messages=" <div class='text-center'>  لا يوجد رسائل سابقة  </div> ";
            }else{

                $messages=" <div class='text-center'>No message </div> ";
            }
            $messagelist=array('message'=>$messages, 'status'=>'no message');
            return JSON_encode($messagelist); 
        }


        }elseif($type=='reservation'){
            $request= Reservation::findorfail($request_id);
            $messages=$request->chats
            ->where(function ($q)use($messageto,$user) {return $q->where('from',$user)->orWhere('from',$messageto);})
           ->where(function ($q)use($messageto,$user) {return $q->where('to',$messageto)->orWhere('to',$user);})->sortBy('created_at');
   
           if( count($messages)>0 ){
               $messagelist=array('message'=>$messages, 'status'=>'found message');
               return JSON_encode($messagelist);
   
           }else{
               if(app()->getLocale()=='ar'){
                   $messages=" <div class='text-center'>  لا يوجد رسائل سابقة  </div> ";
               }else{
   
                   $messages=" <div class='text-center'>No message </div> ";
               }
               $messagelist=array('message'=>$messages, 'status'=>'no message');
               return JSON_encode($messagelist); 
           }
   
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    
     

    }

    
    public function store(Request $request)
    {

        $flag=false;
        $request->validate([
            'request_id'=>'required',
            'to'=>'required',
            'type'=>'required',
            'message'=>'required',

        ]);

    

        if($request->type=="request"){

            $order= Requests::findorfail($request->request_id);
            $order->chats()->create([
              'text'=>$request->message,
              'type'=>trim($request->type),
              'from'=>auth()->user()->id,
              'to'=>$request->to,
            ]);

            $flag=true;

        }elseif($request->type=="reservation"){
            $order= Reservation::findorfail($request->request_id);
            $order->chats()->create([
              'text'=>$request->message,
              'type'=>trim($request->type),
              'from'=>auth()->user()->id,
              'to'=>$request->to,
            ]);

            $flag=true;
        }

       return JSON_decode($flag);

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function edit(chat $chat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, chat $chat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function destroy(chat $chat)
    {
        //
    }
}
