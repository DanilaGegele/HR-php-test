<?php

namespace Tests\Unit;

use App\Container\OrderContainer;
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
            ->make(OrderContainer::class);
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
        $arOrderList = (array)$this->orderList[0];
        $this->assertArrayHasKey('products', $arOrderList);
        $this->assertArrayHasKey('sum', $arOrderList);
        $this->assertArrayHasKey('name_partner', $arOrderList);
        $this->assertArrayHasKey('status', $arOrderList);
    }
}
