<?php

namespace Database\Seeders;

use App\Models\Product;
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
                "unit" => Arr::random(array_keys(Product::PRODUCT_UNITS)),
                "note" => $faker->realText,
                "created_at" => now()->toDateTimeString(),
                "updated_at" => now()->toDateTimeString(),
            ];
        }

        Product::insert($products);
    }
}
