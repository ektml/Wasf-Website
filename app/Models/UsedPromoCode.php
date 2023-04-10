<?php

namespace App\Models;

use App\Models\User;
use App\Models\Discount;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UsedPromoCode extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function discount(){
        return $this->belongsTo(Discount::class);
    }
}
