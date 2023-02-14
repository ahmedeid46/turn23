<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServicePriceList extends Model
{
    use HasFactory;
    function service(){
        return $this->belongsTo(Service::class,'service_id','id');
    }
    function seller(){
        return $this->belongsTo(Seller::class,'seller_id','id');
    }
    function attendeense(){
        return $this->hasMany(Attendeese::class,'price_list_id','id');
    }
}
