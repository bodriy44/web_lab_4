<?php

namespace App\Domain\Cart\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'carts';

        protected $fillable = [
            'total',
            'userId',
            'count'
        ];
}
