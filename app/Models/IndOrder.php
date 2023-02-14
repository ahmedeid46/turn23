<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndOrder extends Model
{
    use HasFactory;
    function customer(){
        return $this->belongsTo(Customer::class,'customer_id','id');
    }
    function product(){
        return $this->belongsTo(IndAllProduct::class,'product_id','id')->with('subcat');
    }
    function admin_ind_all_product(){
        return $this->belongsTo(IndAllProduct::class,'product_id','id');
    }
}
