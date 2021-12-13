<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
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

        if ($product === NULL)
        {
            $throw new NotFoundHttpException('Товар не найден');
        }

        $cart = $this->getCart();

        CartProduct::create([
            'cartId' => $cart->id,
            'productId' => $product->id,
            'count' => $count
        ]);


        return [
           'inCart' => true
        ];
    }

    protected function calculate($cart)
    {

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
