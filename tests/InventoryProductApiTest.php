<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class InventoryProductApiTest extends TestCase
{
    use MakeInventoryProductTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateInventoryProduct()
    {
        $inventoryProduct = $this->fakeInventoryProductData();
        $this->json('POST', '/api/v1/inventoryProducts', $inventoryProduct);

        $this->assertApiResponse($inventoryProduct);
    }

    /**
     * @test
     */
    public function testReadInventoryProduct()
    {
        $inventoryProduct = $this->makeInventoryProduct();
        $this->json('GET', '/api/v1/inventoryProducts/'.$inventoryProduct->id);

        $this->assertApiResponse($inventoryProduct->toArray());
    }

    /**
     * @test
     */
    public function testUpdateInventoryProduct()
    {
        $inventoryProduct = $this->makeInventoryProduct();
        $editedInventoryProduct = $this->fakeInventoryProductData();

        $this->json('PUT', '/api/v1/inventoryProducts/'.$inventoryProduct->id, $editedInventoryProduct);

        $this->assertApiResponse($editedInventoryProduct);
    }

    /**
     * @test
     */
    public function testDeleteInventoryProduct()
    {
        $inventoryProduct = $this->makeInventoryProduct();
        $this->json('DELETE', '/api/v1/inventoryProducts/'.$inventoryProduct->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/inventoryProducts/'.$inventoryProduct->id);

        $this->assertResponseStatus(404);
    }
}
