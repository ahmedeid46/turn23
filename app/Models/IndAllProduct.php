<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndAllProduct extends Model
{
    use HasFactory;
    function product(){
        return $this->hasMany(IndProduct::class,'product_id','id');
    }
    function adminproduct(){
        return $this->hasMany(IndAdminProduct::class,'product_id','id');
    }
    function subcat(){
        return $this->belongsTo(SubCat::class,'subcat_id','id')->with('cat')->with('subCatReverse');
    }
}
