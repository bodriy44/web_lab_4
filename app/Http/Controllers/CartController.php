<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Domain\Cart\Services\CartService;

/**
* Контроллер для управления корзиной
*/
class CartController extends Controller
{

    public function info()
    {
        $service = new CartService();
        return $service->getCart();
    }

    /**
    * Добавляет товар в корзину
    * @param Request request
    * @return array
    */

    public function addToCart(Request $request)
    {
        $service = new CartService();
        $service->addToCart($request->get('id'), $request->get('count', 1));

        return [
           'inCart' => true
        ];
    }
}
