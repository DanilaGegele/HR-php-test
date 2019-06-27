<?php

namespace App\Http\Controllers\Api\v1;

use App\Container\OrderList;
use App\Http\Requests\OrderRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Container\Container;
use App\Container\OrderContainer;
use Carbon\Carbon;
use App\Order;

class OrderController extends Controller
{
    /**
     * @var \Illuminate\Database\Query\Builder
     */
    private $orderList;

    /**
     * @var OrderContainer|mixed
     */
    private $orderContainer;


    public function __construct()
    {
        $this->orderContainer = Container::getInstance()
            ->make(OrderContainer::class);

        $this->orderList = Container::getInstance()
            ->make(OrderList::class);
    }

    /**
     * Вывести просроченные
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function loadOrderOverdue()
    {
        $orderList = $this->orderList
            ->getOrderList()
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
            ->getOrderList()
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
            ->getOrderList()
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
            ->getOrderList()
            ->whereBetween('delivery_dt', [Carbon::now(), Carbon::now()->addDay(1)])
            ->where('status', '=', Order::STATUS_COMPLETED)
            ->orderBy('delivery_dt', 'desc')
            ->paginate(50);

        return response()->json($orderList);
    }

    /**
     * Вывести данные определённого
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getOrder(int $id)
    {
        $orderList = $this->orderList
            ->findOrderList($id);

        return response()->json($orderList);
    }

    public function updateOrder(int $id, OrderRequest $orderRequest)
    {
        $this->orderList->updateOrder($id,$orderRequest->toArray());

        return response('OK!!!', 200);

    }
}
