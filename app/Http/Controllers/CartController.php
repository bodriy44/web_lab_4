<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Domain\Product\Models\Product;
use App\Domain\Cart\Models\Cart;
use App\Domain\Cart\Models\CartProduct;
/**
* Контроллер для управления корзиной
*/
class CartController extends Controller
{

    /**
    * Добавляет товар в корзину
    * @param Request request
    * @return array
    */

    public function addToCart(Request $request)
    {
        $id = $request->get('id');
        $count = $request->get('count', 1);

        $product = Product::query()->where(['id' => $id])->first();

        $cart = Cart::query()
            ->first();

        $cart = $this->getCart();

        CartProduct::create([
            'cartId' => $cart->id,
            'productId' => $product->id,
            'count' => $count
        ]);

        $this->calculate($cart);

        return [
           'inCart' => true
        ];
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

    protected function getCart()
    {
        $cart = Cart::query()->first();

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
