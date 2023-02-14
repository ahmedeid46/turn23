<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndProduct extends Model
{
    use HasFactory;
    function allProduct(){
        return $this->belongsTo(IndAllProduct::class,'product_id','id')->with('subcat');
    }
    function seller(){
        return $this->belongsTo(Seller::class,'seller_id','id');
    }
}
