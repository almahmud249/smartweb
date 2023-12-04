<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;



class Seller extends Authenticatable
{
    use Notifiable;
    use HasApiTokens;


    protected $casts = [
        'id' => 'integer',
        'orders_count' => 'integer',
        'product_count' => 'integer',
        'pos+status' => 'integer'
    ];
    public function shop()
    {
        return $this->hasOne(Shop::class, 'seller_id');
    }

}
