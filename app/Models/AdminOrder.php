<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminOrder extends Model
{
    use HasFactory;
    function adminProduct(){
        return $this->belongsTo(AllProduct::class,'product_id','id');
    }
    function OrderPrices(){
        return $this->hasMany(OrderPrice::class,'admin_order_id','id');
    }
}
