<?php

namespace App\Container;


use App\Order;
use App\OrderProduct;
use App\Partner;
use App\Product;
use Illuminate\Support\Facades\DB;

class OrderContainer
{
    /**
     * @var Order
     */
    private $order;

    /**
     * @var Partner
     */
    private $partner;

    /**
     * @var OrderProduct
     */
    private $orderProduct;

    private $product;

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
     *   Вывести данные о заказах, решил соединить через join
     *      т.к. стандартные связь делает много запросов к базе данных
     *   @return \Illuminate\Database\Query\Builder
     */
    public function getOrderList()
    {
        return DB::table($this->order->getTable())
            ->join($this->partner->getTable(),
                $this->order->getTable() . '.partner_id', '=', $this->partner->getTable() . '.id')// добавляем таблицу партнёры
            ->join($this->orderProduct->getTable(),
                $this->orderProduct->getTable() . '.order_id', '=', $this->order->getTable() . '.id')// добавляем таблицу содержание заказа
            ->join($this->product->getTable(),
                $this->orderProduct->getTable() . '.product_id', '=', $this->product->getTable() . '.id')// добавляем таблицу продукты
            ->groupBy($this->order->getTable() . '.id')
            ->select([
                $this->order->getTable() . '.id',
                $this->partner->getTable() . '.name as name_partner',
                DB::raw('sum(' . $this->orderProduct->getTable() . '.price) * sum(' . $this->orderProduct->getTable() . '.quantity) as `sum`'),
                DB::raw('GROUP_CONCAT(' . $this->product->getTable() . '.name) as `products`'),
                $this->order->getTable() . '.status',
            ]);
    }


}