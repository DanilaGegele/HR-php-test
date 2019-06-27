<?php

namespace Tests\Unit;

use App\Container\OrderContainer;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Container\Container;

class ProductTest extends TestCase
{
    use DatabaseTransactions;

    private $productList;
    protected function setUp()
    {
        parent::setUp();

        /** @var OrderContainer $orderContainer */
        $orderContainer = Container::getInstance()
            ->make(OrderContainer::class);
        $this->productList = $orderContainer->getProduct();
    }

    /**
     * Тест получение списка продуктов
     *
     * @return void
     */
    public function testProductList()
    {
        $product = $this->productList->first();

        $this->assertNotNull($product->id);
        $this->assertNotNull($product->vendor);
    }

    /**
     * Тест получение списка продуктов
     *
     * @return void
     */
    public function testProductUpdate()
    {
        $this->productList
            ->where('id','=',1)
            ->update(['price' => 1000]);

        $productNewPrice = $this->productList
            ->find(1);
        $this->assertEquals($productNewPrice->price ,1000);
    }
}
