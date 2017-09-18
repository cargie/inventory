<?php

use Faker\Factory as Faker;
use App\Models\StockAdjustmentProduct;
use App\Repositories\StockAdjustmentProductRepository;

trait MakeStockAdjustmentProductTrait
{
    /**
     * Create fake instance of StockAdjustmentProduct and save it in database
     *
     * @param array $stockAdjustmentProductFields
     * @return StockAdjustmentProduct
     */
    public function makeStockAdjustmentProduct($stockAdjustmentProductFields = [])
    {
        /** @var StockAdjustmentProductRepository $stockAdjustmentProductRepo */
        $stockAdjustmentProductRepo = App::make(StockAdjustmentProductRepository::class);
        $theme = $this->fakeStockAdjustmentProductData($stockAdjustmentProductFields);
        return $stockAdjustmentProductRepo->create($theme);
    }

    /**
     * Get fake instance of StockAdjustmentProduct
     *
     * @param array $stockAdjustmentProductFields
     * @return StockAdjustmentProduct
     */
    public function fakeStockAdjustmentProduct($stockAdjustmentProductFields = [])
    {
        return new StockAdjustmentProduct($this->fakeStockAdjustmentProductData($stockAdjustmentProductFields));
    }

    /**
     * Get fake data of StockAdjustmentProduct
     *
     * @param array $postFields
     * @return array
     */
    public function fakeStockAdjustmentProductData($stockAdjustmentProductFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'stock_adjustment_id' => $fake->randomDigitNotNull,
            'product_id' => $fake->randomDigitNotNull,
            'quantity' => $fake->randomDigitNotNull,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $stockAdjustmentProductFields);
    }
}
