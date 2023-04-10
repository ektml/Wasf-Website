<?php

namespace App\Notifications\requests;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class CancelRequestByFreelancer extends Notification
{
    use Queueable;
    private $user_create;
    private  $request_id;
    private   $type;
    private   $random_id;
    private  $message_en=" ";
    private  $message_ar=" ";

     public function __construct($user_create,$request,$type ,$random_id)
    {
        $this->user_create=$user_create;
        $this->request_id=$request;
        $this->type=$type;
        $this->random_id=$random_id;


        $this->message_ar = "تم إلغاء الطلب رقم " . $this->random_id . " بواسطة المستقل " . User::find($user_create)->name;
    
        $this->message_en= "request " .$this->random_id.' is cancel by freelancer  '.User::find($user_create)->name ;
        
       
    }

    
    public function via($notifiable)
    {
        return ['database'];
    }

   
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }


    public function toArray($notifiable)
    {

        return [
            'user_create'=> $this->user_create,
            'request_id'=>$this->request_id,
            'type'=>$this->type,
            'random_id'=>$this->random_id,
            "message_en"=>$this->message_en,
            "message_ar"=>$this->message_ar,
        ];
    }
}
