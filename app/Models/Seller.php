<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;


class Seller extends Authenticatable implements JWTSubject
{
    use HasApiTokens,HasFactory,Notifiable;
    protected $guard = 'seller';

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'registration_certificate',
        'tax_card',
        'vat_cert',
        'invoice',
        'delgation',
        'reference_list',
        'status',
        'cat_id',
        'avtar',
        'cv',
        'docs',
        'type_cource',
        'price',
        'Specialization'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
    function cat(){
        return $this->belongsTo(Cat::class,'cat_id','id');
    }
    function sellerCat(): \Illuminate\Database\Eloquent\Relations\HasManyThrough
    {
       return  $this->hasManyThrough(SubCat::class,SellerCat::class,'seller_id','sub_cat_id','id');
    }
    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

}
