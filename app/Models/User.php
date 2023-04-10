<?php
namespace App\Models;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Review;
use App\Models\Wallet;
use App\Models\Product;
use App\Models\Requests;
use App\Models\CardOrder;
use App\Models\FreelancerService;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];


    public function products()
    {
        return $this->hasMany(Product::class);
    }

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier() {
        return $this->getKey();
    }


    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims() {
        return [];
    }



    public function wallet(){

        return $this->hasOne(Wallet::class);
    }

    public function freelancerService(){
        return $this->hasMany(FreelancerService::class,'freelancer_id');
    }
    public function cardorder(){
        return $this->hasMany(CardOrder::class);
    }

    public function  blacklist(){
        return $this->hasMany(BlackListRequest::class,'freelancer_id');
    }

    public function review(){
        return $this->hasMany(Review::class,'freelancer_id');
    }
    public function request(){
        return $this->hasMany(Requests::class,'freelancer_id');
    }

    public function promocodeused(){
        return $this->hasMany(UserPromoCode::class);
    }
}
