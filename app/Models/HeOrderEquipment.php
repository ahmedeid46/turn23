<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeOrderEquipment extends Model
{
    use HasFactory;

     protected $table = 'he_order_equipments';
    function equipments(){
        return $this->belongsTo(SubCat::class,'sub_cat_id','id');
    }
}
