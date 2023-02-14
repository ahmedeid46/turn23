<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndTender extends Model
{
    use HasFactory;
    function tender_price(){
        return $this->hasMany(IndPriceTender::class,'tender_id','id');
    }
    function customer(){
        return $this->belongsTo(Customer::class,'customer_id','id');
    }
}
