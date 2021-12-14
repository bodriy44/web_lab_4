<?php

namespace App\Domain\Cart\Services;
use App\Domain\Product\Models\Product;
use App\Domain\Cart\Models\Cart;
use App\Domain\Cart\Models\CartProduct;

class CartService
{
    public function addToCart($productId, $count, $userId)
    {
        $product = Product::query()->where(['id' => $productId])->first();

        $cart = Cart::query()->first();

        $cart = $this->getCart($userId);

        CartProduct::create([
            'cartId' => $cart->id,
            'productId' => $product->id,
            'count' => $count
        ]);

        $this->calculate($cart);
    }

    protected function calculate($cart)
    {
        $list = CartProduct::query()->with(['product'])->where([
        'cartId' => $cart->id
        ])->get();

        $total = 0;
        $count = 0;

        foreach ($list as $item)
        {
            $total += $item->product->price * $item->count;
            $count += $item->count;
        }

        $cart->total = $total;
        $cart->count = $count;
        $cart->save();
    }

    public function getCart($userId)
    {
        $cart = Cart::query()->where(['id' => $userId])->first();

        if ($cart === NULL)
        {
            Cart::create(
            [
            'total' => 0,
            'count' => 0

            ]);
        }

        return $cart;
    }

}
