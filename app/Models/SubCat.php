<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCat extends Model
{
    use HasFactory;
    public $fillable = [
        'id', 'title', 'cat_id', 'sub_cat_id'
    ];
    function cat()
    {
        return $this->belongsTo(Cat::class,'cat_id','id');

    }
    function subsubCat(){
        return $this->hasMany(SubCat::class,'sub_cat_id','id')->with('subsubCat')->with('ind_allproduct');
    }

    function servicesubCat(){
        return $this->hasMany(SubCat::class,'sub_cat_id','id');
    }
    function subCatReverse(){
        return $this->belongsTo(SubCat::class,'sub_cat_id','id')->with('cat')->with('subCatReverse');
    }
    function allproduct(){
        return $this->hasMany(AllProduct::class,'subcat_id','id')->with('product');
    }
    function ind_allproduct(){
        return $this->hasMany(IndAllProduct::class,'subcat_id','id')->with('product');
    }
    function service(){
        return $this->hasMany(Service::class,'sub_cat_id','id');
    }
}
