<?php
namespace App\Models;
use App\Models\Selled;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Photo extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable=["name","photo","description","lens_type","size_width","size_height","size_type","location","photo","freelancer_id","camera_brand"];
    public function freelancer()
    {
        return $this->belongsTo(User::class);
    }

    public function likes(){
        return $this->morphMany(Like::class,"likesable");
    }

    public function carts(){
        return $this->morphMany(Cart::class,"cartsable");
    }
    public function sells(){
        return $this->morphMany(Selled::class,"selledsable");
    }
}
