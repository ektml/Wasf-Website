<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Selled extends Model
{
    use HasFactory;

    protected $guarded=[];
    public function selledsable(){
        return $this->morphTo();
    }
}
