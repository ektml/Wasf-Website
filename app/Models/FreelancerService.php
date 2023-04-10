<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FreelancerService extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function freelancer(){
        return $this->belongsTo(User::class);
    }
}
