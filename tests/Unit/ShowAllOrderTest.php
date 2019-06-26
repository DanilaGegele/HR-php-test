<?php

namespace Tests\Unit;

use App\Container\OrderContainer;
use App\Container\OrderList;
use Tests\TestCase;
//use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Container\Container;

class ShowAllOrderTest extends TestCase
{

    private $orderList;


    protected function setUp()
    {
        parent::setUp();
        $order = Container::getInstance()
            ->make(OrderList::class);
        $this->orderList = $order->getOrderList()->get();
    }


    /**
     * Тест вывода данных о заказах
     *
     * @return void
     */
    public function testShowOrderList()
    {
        $this->assertTrue(count($this->orderList) > 0);
    }


    /**
     * Проврка вывода коректных полей
     *
     * @return void
     */
    public function testCorrectKeysByOrderList()
    {
        $arOrderList = $this->orderList[0]->toArray();
        $this->assertArrayHasKey('partner', $arOrderList);
        $this->assertArrayHasKey('product', $arOrderList);
        $this->assertArrayHasKey('pivot', $arOrderList['product'][0]);
        $this->assertArrayHasKey('status', $arOrderList);
    }
}
