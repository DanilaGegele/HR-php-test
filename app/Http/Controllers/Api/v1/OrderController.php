<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Container\Container;
use App\Container\OrderContainer;
use Carbon\Carbon;
use App\Order;

class OrderController extends Controller
{

    private $orderList;

    public function __construct()
    {
        $order = Container::getInstance()
            ->make(OrderContainer::class);
        $this->orderList = $order->getOrderList();
    }

    /**
     * Вывести просроченные
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function loadOrderOverdue()
    {
        $orderList = $this->orderList
            ->where('delivery_dt', '<', Carbon::now())
            ->where('status', '=', Order::STATUS_CONFIRMED)
            ->orderBy('delivery_dt', 'desc')
            ->paginate(50);

        return response()->json($orderList);
    }


    /**
     * Вывести текущие
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function loadOrderCurrent()
    {
        $orderList = $this->orderList
            ->whereBetween('delivery_dt', [Carbon::now(), Carbon::now()->addDay(1)])
            ->where('status', '=', Order::STATUS_CONFIRMED)
            ->orderBy('delivery_dt', 'asc')
            ->get();

        return response()->json($orderList);
    }

    /**
     * Вывести новые
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function loadOrderNew()
    {
        $orderList = $this->orderList
            ->where('delivery_dt', '>', Carbon::now()->addDay(1))
            ->where('status', '=', Order::STATUS_NEW)
            ->orderBy('delivery_dt', 'asc')
            ->paginate(50);

        return response()->json($orderList);
    }

    /**
     * Вывести выполненые
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function loadOrderFulfilled()
    {
        $orderList = $this->orderList
            ->whereBetween('delivery_dt', [Carbon::now(), Carbon::now()->addDay(1)])
            ->where('status', '=', Order::STATUS_COMPLETED)
            ->orderBy('delivery_dt', 'desc')
            ->paginate(50);

        return response()->json($orderList);
    }
}
