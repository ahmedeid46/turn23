<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Product extends Model
{
    use HasFactory,SoftDeletes;
    public $fillable=[
        'id', 'title', 'description', 'price', 'sub_cat_id', 'seller_id', 'created_at', 'updated_at', 'qty', 'packing', 'sample', 'ProductionData', 'expirationDate', 'length', 'in_out', 'sch', 'pressure', 'size', 'brand', 'class', 'moc', 'material', 'grade', 'website', 'flowrate', 'content', 'mods', 'tds', 'coa', 'docs', 'cover', 'photos'
    ];
    function allProduct(){
        return $this->belongsTo(AllProduct::class,'product_id','id')->with('subcat');
    }
    function seller(){
        return $this->belongsTo(Seller::class,'seller_id','id');
    }

}
