<?php
namespace App\Models;
use App\Models\Chat;
use App\Models\User;
use App\Models\Offer;
use App\Models\Review;
use App\Models\Payment;
use App\Models\Service;
use App\Models\Category;
use App\Models\Freelancer;
use App\Models\BlackListRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Requests extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function freelancer()
    {
        return $this->belongsTo(User::class,'freelancer_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function review()
    {
     return $this->morphMany(Review::class,'reviewsable');
    }
    public function chats()
    {
        return $this->morphMany(Chat::class,'chatsable');
    }
    public function offer()
    {
        return $this->morphMany(Offer::class,'offersable');
    }
    public function file()
    {
        return $this->morphMany(File::class,'filesable');
    }
    public function payment()
    {
        return $this->morphMany(Payment::class,'paymentsable');
    }

    public function  blacklist(){

        return $this->hasMany(BlackListRequest::class,'request_id');
    }

    
}
