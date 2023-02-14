<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Service extends Model
{
    use HasFactory,SoftDeletes;
    function customer(){
        return $this->belongsTo(Customer::class,'customer_id','id');
    }
    function subCAt(){
        return $this->belongsTo(SubCat::class,'sub_cat_id','id')->with('subCatReverse');
    }
    function price_lists(){
        return $this->hasMany(ServicePriceList::class,'service_id','id')->with('attendeense');
    }
    function seller_price_lists(){
        return $this->hasMany(ServicePriceList::class,'service_id','id')
            ->where('seller_id',auth('seller-api')->user()->getAuthIdentifier())
            ->with('attendeense');
    }
}
