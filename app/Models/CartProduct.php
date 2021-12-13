<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartProduct extends Model
{
    protected $table = 'carts_products';

        protected $fillable = [
            'cartId',
            'productId',
            'count'
        ];
}
