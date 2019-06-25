<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Container\Container;
use App\Container\OrderContainer;

class UpdateOrderTest extends TestCase
{

    /**
     * @var OrderContainer
     */
    private $orderContainer;

    protected function setUp()
    {
        parent::setUp();
        $this->orderContainer = Container::getInstance()
            ->make(OrderContainer::class);
    }

    /**
     * Обновления данных
     *
     * @return void
     */
    public function testUpdate()
    {
        $this->orderContainer->updateOrder(1, [
            'orders.client_email' => 'ShaevMV@gmail.com',
            'orders.partner_id' => 2,
            'orders.status' => 20,
        ]);
        dd($this->orderContainer->getOrderList()->where('orders.id', '=', 1)->first());
        $this->assertTrue(true);
    }
}
