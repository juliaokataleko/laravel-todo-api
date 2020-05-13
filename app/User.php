<?php

namespace App;

use App\models\Archive;
use App\Models\Assinatura;
use App\models\Category;
use App\Models\City;
use App\Models\Customer;
use App\models\Discount;
use App\Models\Equipamento;
use App\models\ImagePerProduct;
use App\Models\Pool;
use App\models\Product;
use App\models\ProductsPerPurchase;
use App\models\Purchase;
use App\Models\Servidor;
use App\Models\State;
use App\models\SubCategory;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'username', 
        'gender', 'phone', 'role',
        'birth_day', 'birth_place', 
        'password', 
        'state_id', 'city_id', 
        'bairro', 
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function images()
    {
        return $this->hasMany(Archive::class);
    }

    public function equipamentos()
    {
        return $this->hasMany(Equipamento::class);
    }

    public function servers()
    {
        return $this->hasMany(Servidor::class);
    }

    public function pools()
    {
        return $this->hasMany(Pool::class);
    }

    public function customers()
    {
        return $this->hasMany(Customer::class, 'por');
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function assinaturas()
    {
        return $this->hasMany(Assinatura::class);
    }
}
