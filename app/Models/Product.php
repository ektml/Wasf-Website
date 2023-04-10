<?php
namespace App\Models;
use App\Models\Cart;
use App\Models\File;
use App\Models\Like;
use App\Models\User;
use App\Models\Selled;
use App\Models\Service;
use App\Models\Category;
use App\Models\ProductProprity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    public function user()
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

    public function proprity(){
        return  $this->hasMany(ProductProprity::class);
    }
    public function file()
    {
        return $this->morphMany(File::class,'filesable');
    }
    public function freelancer()
    {
        return $this->belongsTo(User::class);
    }
    
    public function category()
    {
        return $this->belongsTo(Category::class, 'cat_id');
    }
    
    
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
    
}
