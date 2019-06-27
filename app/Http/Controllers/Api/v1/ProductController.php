<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Requests\ProductRequest;
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

    /**
     * Вывести список продуктов
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getProductList()
    {
        return response()->json(
            $this->product->orderBy('name', 'desc')->paginate(25)
        );
    }

    /**
     * Обновить цену у продукта
     *
     * @param int $id
     * @param ProductRequest $productRequest
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function updateProduct(int $id, ProductRequest $productRequest)
    {
        $this->product->where('id', '=', $id)
            ->update($productRequest->toArray());

        return response('OK!!!', 200);
    }
}
