<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupForTraining extends Model
{
    use HasFactory;
    function training(){
        return $this->hasMany(TrainingGroup::class,'group_id','id')->with('training');
    }
    function seller(){
        return $this->belongsTo(Seller::class,'seller_id','id');
    }
}
