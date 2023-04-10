<?php

namespace App\Models;

use App\Models\UsedPromoCode;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Discount extends Model
{
    use HasFactory;
    protected  $guarded=[];

    
    public function userused(){
        return $this->hasMany(UsedPromoCode::class);
    }
}
