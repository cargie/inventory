<?php

use App\Models\InventoryProduct;
use App\Repositories\InventoryProductRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class InventoryProductRepositoryTest extends TestCase
{
    use MakeInventoryProductTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var InventoryProductRepository
     */
    protected $inventoryProductRepo;

    public function setUp()
    {
        parent::setUp();
        $this->inventoryProductRepo = App::make(InventoryProductRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateInventoryProduct()
    {
        $inventoryProduct = $this->fakeInventoryProductData();
        $createdInventoryProduct = $this->inventoryProductRepo->create($inventoryProduct);
        $createdInventoryProduct = $createdInventoryProduct->toArray();
        $this->assertArrayHasKey('id', $createdInventoryProduct);
        $this->assertNotNull($createdInventoryProduct['id'], 'Created InventoryProduct must have id specified');
        $this->assertNotNull(InventoryProduct::find($createdInventoryProduct['id']), 'InventoryProduct with given id must be in DB');
        $this->assertModelData($inventoryProduct, $createdInventoryProduct);
    }

    /**
     * @test read
     */
    public function testReadInventoryProduct()
    {
        $inventoryProduct = $this->makeInventoryProduct();
        $dbInventoryProduct = $this->inventoryProductRepo->find($inventoryProduct->id);
        $dbInventoryProduct = $dbInventoryProduct->toArray();
        $this->assertModelData($inventoryProduct->toArray(), $dbInventoryProduct);
    }

    /**
     * @test update
     */
    public function testUpdateInventoryProduct()
    {
        $inventoryProduct = $this->makeInventoryProduct();
        $fakeInventoryProduct = $this->fakeInventoryProductData();
        $updatedInventoryProduct = $this->inventoryProductRepo->update($fakeInventoryProduct, $inventoryProduct->id);
        $this->assertModelData($fakeInventoryProduct, $updatedInventoryProduct->toArray());
        $dbInventoryProduct = $this->inventoryProductRepo->find($inventoryProduct->id);
        $this->assertModelData($fakeInventoryProduct, $dbInventoryProduct->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteInventoryProduct()
    {
        $inventoryProduct = $this->makeInventoryProduct();
        $resp = $this->inventoryProductRepo->delete($inventoryProduct->id);
        $this->assertTrue($resp);
        $this->assertNull(InventoryProduct::find($inventoryProduct->id), 'InventoryProduct should not exist in DB');
    }
}
