<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticate;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;


class Customer extends Authenticate implements JWTSubject
{
    use HasApiTokens,HasFactory,Notifiable;
    protected $guard = 'customer';

    protected $fillable = [
        'name', 'email', 'password','phone', 'registration_certificate', 'tax_card', 'vat_cert', 'invoice', 'delgation', 'reference_list', 'status',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
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
    function service(){
        return $this->hasMany(Service::class,'customer_id','id');
    }

}
