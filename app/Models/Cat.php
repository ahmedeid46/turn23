<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cat extends Model
{
    use HasFactory;
    function subCat(){
        return $this->hasMany(SubCat::class,'cat_id','id')->with('subsubCat')->with('allproduct')->with('ind_allproduct');
    }
}
