<?php

namespace Tests\Unit;

use App\Container\OrderList;
use Tests\TestCase;
use Illuminate\Container\Container;
use App\Container\OrderContainer;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UpdateOrderTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * @var OrderContainer
     */
    private $orderContainer;
    /**
     * @var OrderList
     */
    private $orderList;


    protected function setUp()
    {
        parent::setUp();
        $this->orderContainer = Container::getInstance()
            ->make(OrderContainer::class);

        $this->orderList = Container::getInstance()
            ->make(OrderList::class);
    }

    /**
     * Проврка вывода конкретного заказа
     *
     * @return void
     */
    public function testFindOrder()
    {
        $order = $this->orderList
            ->findOrderList(1);

        $this->assertTrue($order->id === 1);
    }

    /**
     * Обновления данных в заказе
     *
     * @return void
     */
    public function testUpdate()
    {
        $this->orderList->updateOrder(1, [
            'orders.client_email' => 'ShaevMV@gmail.com',
            'orders.partner_id' => 2,
            'orders.status' => 20,
        ]);

        $order = $this->orderList
            ->getOrder()
            ->find(1)
            ->first();

        $this->assertTrue($order->id === 1);
        $this->assertTrue($order->client_email === 'ShaevMV@gmail.com');
        $this->assertTrue($order->status === 20);
    }

    /**
     * Тест проверки вывода списка Продуктов
     */
    public function testGetProductList()
    {
        $products = $this->orderContainer
            ->getProduct()
            ->all();
        $this->assertTrue(count($products) > 0);
    }


    /**
     * Тест проверки вывода списка партнёров
     */
    public function testGetPartnersList()
    {
        $partners = $this->orderContainer
            ->getPartner()
            ->all();
        $this->assertTrue(count($partners) > 0);
    }

}
