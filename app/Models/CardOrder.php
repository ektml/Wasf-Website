<?php

namespace App\Models;

use App\Models\User;
use App\Models\Payment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CardOrder extends Model
{
    use HasFactory;

protected $guarded=[];

public function user(){
    return $thius->belongsTo(User::class);
}

public function payment()
    {
        return $this->morphMany(Payment::class,'paymentsable');
    }
}
