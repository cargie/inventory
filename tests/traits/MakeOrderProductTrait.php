<?php

use Faker\Factory as Faker;
use App\Models\OrderProduct;
use App\Repositories\OrderProductRepository;

trait MakeOrderProductTrait
{
    /**
     * Create fake instance of OrderProduct and save it in database
     *
     * @param array $orderProductFields
     * @return OrderProduct
     */
    public function makeOrderProduct($orderProductFields = [])
    {
        /** @var OrderProductRepository $orderProductRepo */
        $orderProductRepo = App::make(OrderProductRepository::class);
        $theme = $this->fakeOrderProductData($orderProductFields);
        return $orderProductRepo->create($theme);
    }

    /**
     * Get fake instance of OrderProduct
     *
     * @param array $orderProductFields
     * @return OrderProduct
     */
    public function fakeOrderProduct($orderProductFields = [])
    {
        return new OrderProduct($this->fakeOrderProductData($orderProductFields));
    }

    /**
     * Get fake data of OrderProduct
     *
     * @param array $postFields
     * @return array
     */
    public function fakeOrderProductData($orderProductFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'order_id' => $fake->randomDigitNotNull,
            'product_id' => $fake->randomDigitNotNull,
            'quantity' => $fake->randomDigitNotNull,
            'price' => $fake->word,
            'amount' => $fake->word,
            'discount' => $fake->word,
            'var' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $orderProductFields);
    }
}
