<?php

namespace App\Notifications\reservation;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class AcceptOffer extends Notification
{
    use Queueable;

    private $user_create;
    private  $reservation_id;
    private   $type;
    private   $random_id;
    private  $message_en=" ";
    private  $message_ar=" ";

     public function __construct($user_create,$reservation_id,$type ,$random_id)
    {
        $this->user_create=$user_create;
        $this->reservation_id=$reservation_id;
        $this->type=$type;
        $this->random_id=$random_id;
        
        $this->message_ar = "تم قبول عرضك في الحجز رقم " . $this->random_id . " من قبل " . User::find($user_create)->name;

        $this->message_en =  "Your offer in reservation " . $this->random_id . " has been accepted by " . User::find($user_create)->name;
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
            'reservation_id'=>$this->reservation_id,
            'type'=>$this->type,
            'random_id'=>$this->random_id,
            "message_en"=>$this->message_en,
            "message_ar"=>$this->message_ar,
        ];
    }
}
