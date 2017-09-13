<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PaymentApiTest extends TestCase
{
    use MakePaymentTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreatePayment()
    {
        $payment = $this->fakePaymentData();
        $this->json('POST', '/api/v1/payments', $payment);

        $this->assertApiResponse($payment);
    }

    /**
     * @test
     */
    public function testReadPayment()
    {
        $payment = $this->makePayment();
        $this->json('GET', '/api/v1/payments/'.$payment->id);

        $this->assertApiResponse($payment->toArray());
    }

    /**
     * @test
     */
    public function testUpdatePayment()
    {
        $payment = $this->makePayment();
        $editedPayment = $this->fakePaymentData();

        $this->json('PUT', '/api/v1/payments/'.$payment->id, $editedPayment);

        $this->assertApiResponse($editedPayment);
    }

    /**
     * @test
     */
    public function testDeletePayment()
    {
        $payment = $this->makePayment();
        $this->json('DELETE', '/api/v1/payments/'.$payment->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/payments/'.$payment->id);

        $this->assertResponseStatus(404);
    }
}
