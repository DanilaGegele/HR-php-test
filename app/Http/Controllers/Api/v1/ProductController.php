<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Container\OrderContainer;
use Illuminate\Container\Container;

class ProductController extends Controller
{
    /**
     * @var \App\Product
     */
    private $product;


    public function __construct()
    {
        $this->product = Container::getInstance()
            ->make(OrderContainer::class)->getProduct();
    }

    public function getProductList()
    {
        return response()->json($this->product->get());
    }
}
