<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeOrder extends Model
{
    use HasFactory;
    function order_equipments()
    {
        return $this->hasMany(HeOrderEquipment::class, 'order_id', 'id')->with('equipments');
    }
    function order_price(){
        return $this->hasMany(HeOrderPrice::class,'order_id','id')->with('equipment_price')->with('seller');
    }
    function customer(){
        return $this->belongsTo(Customer::class,'customer_id','id');
    }
}
