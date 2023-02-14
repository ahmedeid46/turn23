<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndOrderPrice extends Model
{
    use HasFactory;
    function seller(){
        return $this->belongsTo(Seller::class,'seller_id','id');
    }
}
