<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeOrderPrice extends Model
{
    use HasFactory;
    function equipment_price(){
        return $this->hasMany(HeEquipmentPrice::class,'order_price_id','id');
    }
    function seller(){
        return $this->belongsTo(Seller::class,'seller_id','id');
    }
}
