<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndAdminOrder extends Model
{
    use HasFactory;
    function adminProduct(){
        return $this->belongsTo(IndAllProduct::class,'product_id','id');
    }
    function OrderPrices(){
        return $this->hasMany(IndOrderPrice::class,'admin_order_id','id');
    }
    function order(){
        return $this->belongsTo(IndOrder::class,'order_id','id');
    }
}
