<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trining extends Model
{
    use HasFactory;
    function customer(){
        return $this->belongsTo(Customer::class,'customer_id','id');
    }
    function trainer(){
        return $this->belongsTo(Seller::class,'seller_id','id');
    }
    function groups(){
        return $this->hasMany(TrainingGroup::class,'training_id','id')->with('group');
    }
}
