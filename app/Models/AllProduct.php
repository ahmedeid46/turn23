<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AllProduct extends Model
{
    use HasFactory;
    function product(){
        return $this->hasMany(Product::class,'product_id','id');
    }
    function adminproduct(){
        return $this->hasMany(AdminProduct::class,'product_id','id');
    }
    function subcat(){
        return $this->belongsTo(SubCat::class,'subcat_id','id')->with('cat')->with('subCatReverse');
    }
}
