<?php
namespace App\Models;
use App\Models\Requests;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Freelancer extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function requests()
    {
        return $this->hasMany(Requests::class);
    }
}
