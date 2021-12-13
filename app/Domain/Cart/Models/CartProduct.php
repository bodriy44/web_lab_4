<?php

namespace App\Domain\Cart\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Domain\Product\Models\Product;

class CartProduct extends Model
{
    protected $table = 'carts_products';

        protected $fillable = [
            'cartId',
            'productId',
            'count'
        ];

    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'productId');
    }
}
