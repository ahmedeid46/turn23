<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellerCat extends Model
{
    use HasFactory;
    protected $fillable = [
        'id','sub_cat_id','seller_id'
    ];

    function subCat(){
       return $this->belongsTo(SubCat::class,'sub_cat_id','id')->with('allproduct')->with('subsubCat');
    }
    function ind_cats(){
        return $this->belongsTo(SubCat::class,'sub_cat_id','id')->with('subsubCat');
    }
    function serviceCat(){
        return $this->belongsTo(SubCat::class,'sub_cat_id','id')->with('subCatReverse');
    }

}
