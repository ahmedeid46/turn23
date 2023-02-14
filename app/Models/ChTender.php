<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChTender extends Model
{
    use HasFactory;
    function tender_price(){
        return $this->hasMany(ChPriceTender::class,'tender_id','id');
    }
    function customer(){
        return $this->belongsTo(Customer::class,'customer_id','id');
    }
}
