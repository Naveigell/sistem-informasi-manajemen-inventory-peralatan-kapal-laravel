<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductSnapshot;
use App\Models\Supplier;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('id_ID');
        $products = [];

        $suppliers = Supplier::all();

        foreach (range(1, 10) as $item) {
            $products[] = [
                "supplier_id" => $suppliers->random()->id,
                "name" => $faker->country . '-' . $faker->countryCode,
                "price" => pow(10, rand(4, 7)) * rand(2, 10),
                "unit" => Arr::random(array_keys(Product::PRODUCT_UNITS)),
                "note" => $faker->realText,
                "created_at" => now()->toDateTimeString(),
                "updated_at" => now()->toDateTimeString(),
            ];
        }

        Product::insert($products);

        $products = Product::all();

        // we create product snapshot too in seeder, because the snapshot_id will be use in request order table
        // it's mean, product at least has one snapshot, for the first snapshot
        foreach ($products as $product) {
            $snapshot = new ProductSnapshot($product->getAttributeWithoutUnusedAttributes()); // we remove unused attribute such like id, created_at and updated_at
            $snapshot->product()
                ->associate($product)
                ->save();
        }
    }
}
