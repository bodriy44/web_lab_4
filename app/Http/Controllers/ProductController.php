<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use App\Models\Product;

/**
* Контроллер для управления товарами
*/
class ProductController extends Controller
{

    public $arr;

    public function init()
    {
        $this->arr = Product::query()->get();
    }

    /**
    * Список товаров.
    * @return array
    */
    public function list()
    {
        $this->init();
        return $this->arr;
    }

    /**
    * Информация о товаре
    * @param $id
    * @return array
    */
    public function info($id)
    {
        $this->init();
        return  $this->arr[$id-1];
    }
}
