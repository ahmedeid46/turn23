<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndWishlist extends Model
{
    use HasFactory;
    public function product(){
        return $this->belongsTo(IndAdminProduct::class,'product_id','id');
    }
}
