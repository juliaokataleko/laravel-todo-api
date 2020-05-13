<?php

namespace App\models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    protected $fillable = [
        'name', 'url', 
        'email',
        'cnpj',
        'celular',
        'telefone',
        'endereco', 
        'razao_social',
        'slogan', 
        'num_pages', 
        'about', 
        'state_id',
        'city_id',
        'privacy_policy'
    ];

    public static function num_pages() {
        $config = Config::first();
        return $config->num_pages;
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function state()
    {
        return $this->belongsTo(State::class, 'state_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }
}
