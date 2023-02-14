<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Charts extends Model
{
    use HasFactory;
    public $fillable =[
        'id', 'product_id', 'customer_id'
    ];
    function product(){
        return $this->belongsTo(AdminProduct::class,'product_id','id');
    }
}
