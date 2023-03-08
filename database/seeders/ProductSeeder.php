<?php

namespace Database\Seeders;

use App\Models\Product;
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

        foreach (range(1, 10) as $item) {
            $products[] = [
                "name" => $faker->city . '-' . $faker->uuid,
                "unit" => Arr::random(array_keys(Product::PRODUCT_UNITS)),
                "note" => $faker->realText,
                "created_at" => now()->toDateTimeString(),
                "updated_at" => now()->toDateTimeString(),
            ];
        }

        Product::insert($products);
    }
}
