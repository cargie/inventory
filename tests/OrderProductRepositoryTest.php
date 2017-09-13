<?php

use App\Models\OrderProduct;
use App\Repositories\OrderProductRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class OrderProductRepositoryTest extends TestCase
{
    use MakeOrderProductTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var OrderProductRepository
     */
    protected $orderProductRepo;

    public function setUp()
    {
        parent::setUp();
        $this->orderProductRepo = App::make(OrderProductRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateOrderProduct()
    {
        $orderProduct = $this->fakeOrderProductData();
        $createdOrderProduct = $this->orderProductRepo->create($orderProduct);
        $createdOrderProduct = $createdOrderProduct->toArray();
        $this->assertArrayHasKey('id', $createdOrderProduct);
        $this->assertNotNull($createdOrderProduct['id'], 'Created OrderProduct must have id specified');
        $this->assertNotNull(OrderProduct::find($createdOrderProduct['id']), 'OrderProduct with given id must be in DB');
        $this->assertModelData($orderProduct, $createdOrderProduct);
    }

    /**
     * @test read
     */
    public function testReadOrderProduct()
    {
        $orderProduct = $this->makeOrderProduct();
        $dbOrderProduct = $this->orderProductRepo->find($orderProduct->id);
        $dbOrderProduct = $dbOrderProduct->toArray();
        $this->assertModelData($orderProduct->toArray(), $dbOrderProduct);
    }

    /**
     * @test update
     */
    public function testUpdateOrderProduct()
    {
        $orderProduct = $this->makeOrderProduct();
        $fakeOrderProduct = $this->fakeOrderProductData();
        $updatedOrderProduct = $this->orderProductRepo->update($fakeOrderProduct, $orderProduct->id);
        $this->assertModelData($fakeOrderProduct, $updatedOrderProduct->toArray());
        $dbOrderProduct = $this->orderProductRepo->find($orderProduct->id);
        $this->assertModelData($fakeOrderProduct, $dbOrderProduct->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteOrderProduct()
    {
        $orderProduct = $this->makeOrderProduct();
        $resp = $this->orderProductRepo->delete($orderProduct->id);
        $this->assertTrue($resp);
        $this->assertNull(OrderProduct::find($orderProduct->id), 'OrderProduct should not exist in DB');
    }
}
