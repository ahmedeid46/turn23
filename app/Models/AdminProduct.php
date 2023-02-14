<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminProduct extends Model
{
    use HasFactory;
    function allProduct(){
        return $this->belongsTo(AllProduct::class,'product_id','id')->with('subcat');
    }
}
