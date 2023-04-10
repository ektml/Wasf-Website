<?php
namespace App\Models;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;

    // protected $fillable = ['user_id','freelancer_id','status','pay_type','total','discount','visapay_id'];

    protected $guarded=[];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function paymentsable(){
        return $this->morphTo();
    }
}
