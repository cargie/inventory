<?php

use Faker\Factory as Faker;
use App\Models\InventoryProduct;
use App\Repositories\InventoryProductRepository;

trait MakeInventoryProductTrait
{
    /**
     * Create fake instance of InventoryProduct and save it in database
     *
     * @param array $inventoryProductFields
     * @return InventoryProduct
     */
    public function makeInventoryProduct($inventoryProductFields = [])
    {
        /** @var InventoryProductRepository $inventoryProductRepo */
        $inventoryProductRepo = App::make(InventoryProductRepository::class);
        $theme = $this->fakeInventoryProductData($inventoryProductFields);
        return $inventoryProductRepo->create($theme);
    }

    /**
     * Get fake instance of InventoryProduct
     *
     * @param array $inventoryProductFields
     * @return InventoryProduct
     */
    public function fakeInventoryProduct($inventoryProductFields = [])
    {
        return new InventoryProduct($this->fakeInventoryProductData($inventoryProductFields));
    }

    /**
     * Get fake data of InventoryProduct
     *
     * @param array $postFields
     * @return array
     */
    public function fakeInventoryProductData($inventoryProductFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'inventory_id' => $fake->randomDigitNotNull,
            'product_id' => $fake->randomDigitNotNull,
            'quantity' => $fake->randomDigitNotNull,
            'price_per_unit' => $fake->word,
            'total_amount' => $fake->word,
            'sold_quantity' => $fake->randomDigitNotNull,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $inventoryProductFields);
    }
}
