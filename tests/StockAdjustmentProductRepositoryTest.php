<?php

use App\Models\StockAdjustmentProduct;
use App\Repositories\StockAdjustmentProductRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class StockAdjustmentProductRepositoryTest extends TestCase
{
    use MakeStockAdjustmentProductTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var StockAdjustmentProductRepository
     */
    protected $stockAdjustmentProductRepo;

    public function setUp()
    {
        parent::setUp();
        $this->stockAdjustmentProductRepo = App::make(StockAdjustmentProductRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateStockAdjustmentProduct()
    {
        $stockAdjustmentProduct = $this->fakeStockAdjustmentProductData();
        $createdStockAdjustmentProduct = $this->stockAdjustmentProductRepo->create($stockAdjustmentProduct);
        $createdStockAdjustmentProduct = $createdStockAdjustmentProduct->toArray();
        $this->assertArrayHasKey('id', $createdStockAdjustmentProduct);
        $this->assertNotNull($createdStockAdjustmentProduct['id'], 'Created StockAdjustmentProduct must have id specified');
        $this->assertNotNull(StockAdjustmentProduct::find($createdStockAdjustmentProduct['id']), 'StockAdjustmentProduct with given id must be in DB');
        $this->assertModelData($stockAdjustmentProduct, $createdStockAdjustmentProduct);
    }

    /**
     * @test read
     */
    public function testReadStockAdjustmentProduct()
    {
        $stockAdjustmentProduct = $this->makeStockAdjustmentProduct();
        $dbStockAdjustmentProduct = $this->stockAdjustmentProductRepo->find($stockAdjustmentProduct->id);
        $dbStockAdjustmentProduct = $dbStockAdjustmentProduct->toArray();
        $this->assertModelData($stockAdjustmentProduct->toArray(), $dbStockAdjustmentProduct);
    }

    /**
     * @test update
     */
    public function testUpdateStockAdjustmentProduct()
    {
        $stockAdjustmentProduct = $this->makeStockAdjustmentProduct();
        $fakeStockAdjustmentProduct = $this->fakeStockAdjustmentProductData();
        $updatedStockAdjustmentProduct = $this->stockAdjustmentProductRepo->update($fakeStockAdjustmentProduct, $stockAdjustmentProduct->id);
        $this->assertModelData($fakeStockAdjustmentProduct, $updatedStockAdjustmentProduct->toArray());
        $dbStockAdjustmentProduct = $this->stockAdjustmentProductRepo->find($stockAdjustmentProduct->id);
        $this->assertModelData($fakeStockAdjustmentProduct, $dbStockAdjustmentProduct->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteStockAdjustmentProduct()
    {
        $stockAdjustmentProduct = $this->makeStockAdjustmentProduct();
        $resp = $this->stockAdjustmentProductRepo->delete($stockAdjustmentProduct->id);
        $this->assertTrue($resp);
        $this->assertNull(StockAdjustmentProduct::find($stockAdjustmentProduct->id), 'StockAdjustmentProduct should not exist in DB');
    }
}
