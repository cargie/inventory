<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class StockAdjustmentProductApiTest extends TestCase
{
    use MakeStockAdjustmentProductTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateStockAdjustmentProduct()
    {
        $stockAdjustmentProduct = $this->fakeStockAdjustmentProductData();
        $this->json('POST', '/api/v1/stockAdjustmentProducts', $stockAdjustmentProduct);

        $this->assertApiResponse($stockAdjustmentProduct);
    }

    /**
     * @test
     */
    public function testReadStockAdjustmentProduct()
    {
        $stockAdjustmentProduct = $this->makeStockAdjustmentProduct();
        $this->json('GET', '/api/v1/stockAdjustmentProducts/'.$stockAdjustmentProduct->id);

        $this->assertApiResponse($stockAdjustmentProduct->toArray());
    }

    /**
     * @test
     */
    public function testUpdateStockAdjustmentProduct()
    {
        $stockAdjustmentProduct = $this->makeStockAdjustmentProduct();
        $editedStockAdjustmentProduct = $this->fakeStockAdjustmentProductData();

        $this->json('PUT', '/api/v1/stockAdjustmentProducts/'.$stockAdjustmentProduct->id, $editedStockAdjustmentProduct);

        $this->assertApiResponse($editedStockAdjustmentProduct);
    }

    /**
     * @test
     */
    public function testDeleteStockAdjustmentProduct()
    {
        $stockAdjustmentProduct = $this->makeStockAdjustmentProduct();
        $this->json('DELETE', '/api/v1/stockAdjustmentProducts/'.$stockAdjustmentProduct->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/stockAdjustmentProducts/'.$stockAdjustmentProduct->id);

        $this->assertResponseStatus(404);
    }
}
