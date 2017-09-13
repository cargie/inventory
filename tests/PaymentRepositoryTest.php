<?php

use App\Models\Payment;
use App\Repositories\PaymentRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PaymentRepositoryTest extends TestCase
{
    use MakePaymentTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var PaymentRepository
     */
    protected $paymentRepo;

    public function setUp()
    {
        parent::setUp();
        $this->paymentRepo = App::make(PaymentRepository::class);
    }

    /**
     * @test create
     */
    public function testCreatePayment()
    {
        $payment = $this->fakePaymentData();
        $createdPayment = $this->paymentRepo->create($payment);
        $createdPayment = $createdPayment->toArray();
        $this->assertArrayHasKey('id', $createdPayment);
        $this->assertNotNull($createdPayment['id'], 'Created Payment must have id specified');
        $this->assertNotNull(Payment::find($createdPayment['id']), 'Payment with given id must be in DB');
        $this->assertModelData($payment, $createdPayment);
    }

    /**
     * @test read
     */
    public function testReadPayment()
    {
        $payment = $this->makePayment();
        $dbPayment = $this->paymentRepo->find($payment->id);
        $dbPayment = $dbPayment->toArray();
        $this->assertModelData($payment->toArray(), $dbPayment);
    }

    /**
     * @test update
     */
    public function testUpdatePayment()
    {
        $payment = $this->makePayment();
        $fakePayment = $this->fakePaymentData();
        $updatedPayment = $this->paymentRepo->update($fakePayment, $payment->id);
        $this->assertModelData($fakePayment, $updatedPayment->toArray());
        $dbPayment = $this->paymentRepo->find($payment->id);
        $this->assertModelData($fakePayment, $dbPayment->toArray());
    }

    /**
     * @test delete
     */
    public function testDeletePayment()
    {
        $payment = $this->makePayment();
        $resp = $this->paymentRepo->delete($payment->id);
        $this->assertTrue($resp);
        $this->assertNull(Payment::find($payment->id), 'Payment should not exist in DB');
    }
}
