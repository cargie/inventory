<?php

use Faker\Factory as Faker;
use App\Models\StockAdjustment;
use App\Repositories\StockAdjustmentRepository;

trait MakeStockAdjustmentTrait
{
    /**
     * Create fake instance of StockAdjustment and save it in database
     *
     * @param array $stockAdjustmentFields
     * @return StockAdjustment
     */
    public function makeStockAdjustment($stockAdjustmentFields = [])
    {
        /** @var StockAdjustmentRepository $stockAdjustmentRepo */
        $stockAdjustmentRepo = App::make(StockAdjustmentRepository::class);
        $theme = $this->fakeStockAdjustmentData($stockAdjustmentFields);
        return $stockAdjustmentRepo->create($theme);
    }

    /**
     * Get fake instance of StockAdjustment
     *
     * @param array $stockAdjustmentFields
     * @return StockAdjustment
     */
    public function fakeStockAdjustment($stockAdjustmentFields = [])
    {
        return new StockAdjustment($this->fakeStockAdjustmentData($stockAdjustmentFields));
    }

    /**
     * Get fake data of StockAdjustment
     *
     * @param array $postFields
     * @return array
     */
    public function fakeStockAdjustmentData($stockAdjustmentFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'uid' => $fake->word,
            'reason' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $stockAdjustmentFields);
    }
}
