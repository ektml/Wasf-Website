<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductProprity extends Model
{
    use HasFactory;
    protected $table = 'product_props';
    protected $guarded=[];

    public function product(){
        return $this->belongsTo(Product::class);
    }
}
