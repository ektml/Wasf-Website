<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $fillable=['name',"type",'size','url','user_id','filesable_id','filesable_type'];

    public function filesable(){
        return $this->morphTo();
    }
}
