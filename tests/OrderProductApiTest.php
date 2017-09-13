<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class OrderProductApiTest extends TestCase
{
    use MakeOrderProductTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateOrderProduct()
    {
        $orderProduct = $this->fakeOrderProductData();
        $this->json('POST', '/api/v1/orderProducts', $orderProduct);

        $this->assertApiResponse($orderProduct);
    }

    /**
     * @test
     */
    public function testReadOrderProduct()
    {
        $orderProduct = $this->makeOrderProduct();
        $this->json('GET', '/api/v1/orderProducts/'.$orderProduct->id);

        $this->assertApiResponse($orderProduct->toArray());
    }

    /**
     * @test
     */
    public function testUpdateOrderProduct()
    {
        $orderProduct = $this->makeOrderProduct();
        $editedOrderProduct = $this->fakeOrderProductData();

        $this->json('PUT', '/api/v1/orderProducts/'.$orderProduct->id, $editedOrderProduct);

        $this->assertApiResponse($editedOrderProduct);
    }

    /**
     * @test
     */
    public function testDeleteOrderProduct()
    {
        $orderProduct = $this->makeOrderProduct();
        $this->json('DELETE', '/api/v1/orderProducts/'.$orderProduct->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/orderProducts/'.$orderProduct->id);

        $this->assertResponseStatus(404);
    }
}
