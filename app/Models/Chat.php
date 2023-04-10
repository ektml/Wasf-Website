<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;
protected $fillable=['text','type','to','from'];
    public function chatsable(){
        return $this->morphTo();
    }
}
