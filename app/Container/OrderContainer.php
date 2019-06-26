<?php

namespace App\Container;


use App\Order;
use App\OrderProduct;
use App\Partner;
use App\Product;

class OrderContainer
{
    /**
     * @var Order
     */
    protected $order;

    /**
     * @var Partner
     */
    protected $partner;

    /**
     * @var OrderProduct
     */
    protected $orderProduct;

    /**
     * @var Product
     */
    protected $product;


    public function __construct(Order $order,
                                Partner $partner,
                                OrderProduct $orderProduct,
                                Product $product)
    {
        $this->order = $order;
        $this->partner = $partner;
        $this->orderProduct = $orderProduct;
        $this->product = $product;
    }

    /**
     * @return Partner
     */
    public function getPartner(): Partner
    {
        return $this->partner;
    }

    /**
     * @return Product
     */
    public function getProduct(): Product
    {
        return $this->product;
    }

    /**
     * @return Order
     */
    public function getOrder(): Order
    {
        return $this->order;
    }

    /**
     * @return OrderProduct
     */
    public function getOrderProduct(): OrderProduct
    {
        return $this->orderProduct;
    }



}