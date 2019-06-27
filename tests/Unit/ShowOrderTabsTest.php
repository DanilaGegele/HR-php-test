<?php

namespace Tests\Unit;

use App\Container\OrderContainer;
use App\Container\OrderList;
use App\Order;
use Tests\TestCase;
//use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Container\Container;
use Carbon\Carbon;

class ShowOrderTabsTest extends TestCase
{

    /**
     * @var \Illuminate\Database\Query\Builder
     */
    private $orderList;

    protected function setUp()
    {
        parent::setUp();
        $order = Container::getInstance()
            ->make(OrderList::class);
        $this->orderList = $order->getOrderList();
    }

    /**
     * Вывести просроченные заказы
     *
     * @return void
     */
    public function testTabOverdue()
    {
        $orderList = $this->orderList
            ->where('delivery_dt', '<', Carbon::now())
            ->where('status', '=', Order::STATUS_CONFIRMED)
            ->orderBy('delivery_dt', 'desc')
            ->paginate(50);

        $this->assertInstanceOf(\Illuminate\Pagination\LengthAwarePaginator::class, $orderList);
        $this->assertTrue(count($orderList) <= 50);
        $this->assertTrue($orderList[0]->status === Order::STATUS_CONFIRMED);
        $this->assertTrue($orderList[0]->delivery_dt >= $orderList[1]->delivery_dt);
    }

    /**
     * Вывести текущие заказы
     *
     * @return void
     */
    public function testTabCurrent()
    {
        $orderList = $this->orderList
            ->whereBetween('delivery_dt', [Carbon::now(), Carbon::now()->addDay(1)])
            ->where('status', '=', Order::STATUS_CONFIRMED)
            ->orderBy('delivery_dt', 'asc')
            ->get();
        $this->assertInstanceOf(\Illuminate\Support\Collection::class, $orderList);
        $this->assertTrue($orderList[0]->status === Order::STATUS_CONFIRMED);
        $this->assertTrue($orderList[0]->delivery_dt <= $orderList[1]->delivery_dt);
    }

    /**
     * Вывести новые заказы
     *
     * @return void
     */
    public function testTabNew()
    {
        $orderList = $this->orderList
            ->where('delivery_dt', '>', Carbon::now()->addDay(1))
            ->where('status', '=', Order::STATUS_NEW)
            ->orderBy('delivery_dt', 'asc')
            ->paginate(50);

        $this->assertInstanceOf(\Illuminate\Pagination\LengthAwarePaginator::class, $orderList);
        $this->assertTrue(count($orderList) <= 50);
        $this->assertTrue($orderList[0]->status === Order::STATUS_NEW);
        $this->assertTrue($orderList[0]->delivery_dt <= $orderList[1]->delivery_dt);
    }

    /**
     * Вывести выполненные заказы
     *
     * @return void
     */
    public function testTabFulfilled()
    {
        $orderList = $this->orderList
            ->whereBetween('delivery_dt', [Carbon::now(), Carbon::now()->addDay(1)])
            ->where('status', '=', Order::STATUS_COMPLETED)
            ->orderBy('delivery_dt', 'desc')
            ->paginate(50);

        $this->assertInstanceOf(\Illuminate\Pagination\LengthAwarePaginator::class, $orderList);
        $this->assertTrue(count($orderList) <= 50);
        $this->assertTrue($orderList[0]->status === Order::STATUS_COMPLETED);
        $this->assertTrue($orderList[0]->delivery_dt >= $orderList[1]->delivery_dt);
    }


}
