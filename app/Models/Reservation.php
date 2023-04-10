<?php
namespace App\Models;
use App\Models\ReservationDelay;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reservation extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function payment()
    {
        return $this->morphMany(Payment::class,'paymentsable');
    }

    public function chats()
    {
        return $this->morphMany(Chat::class,'chatsable');
    }

    public function offer()
    {
        return $this->morphMany(Offer::class,'offersable');
    }
    public function review()
    {
     return $this->morphMany(Review::class,'reviewsable');
    }

    public function delay(){
        return $this->hasMany(ReservationDelay::class);
    }
}
