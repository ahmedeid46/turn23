<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingGroup extends Model
{
    use HasFactory;
    function training(){
        return $this->belongsTo(Trining::class,'training_id','id')->with('customer');
    }
    function group(){
        return $this->belongsTo(GroupForTraining::class,'group_id','id')->with('seller');
    }

}
