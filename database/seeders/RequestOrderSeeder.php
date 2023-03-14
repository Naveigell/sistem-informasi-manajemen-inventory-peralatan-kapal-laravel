<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\RequestOrder;
use App\Models\RequestOrderDetail;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RequestOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('id_ID');
        $requests = [];

        foreach (range(1, 30) as $item) {
            $requests[] = [
                "request_order_random_code" => "REQUEST-" . strtoupper(uniqid()),
                "created_at" => now()->toDateTimeString(),
                "updated_at" => now()->toDateTimeString(),
            ];
        }

        RequestOrder::insert($requests);

        $requests = RequestOrder::all();
        $products = Product::all();

        $requestOrderDetails = [];

        foreach ($requests as $request) {
            foreach (range(1, rand(3, 5)) as $item) {
                $product = $products->random();

                $requestOrderDetails[] = [
                    "product_id" => $product->id,
                    "supplier_id" => $product->supplier_id,
                    "request_id" => $request->id,
                    "quantity" => rand(2, 5),
                    "created_at" => now()->toDateTimeString(),
                    "updated_at" => now()->toDateTimeString(),
                ];
            }
        }

        RequestOrderDetail::insert($requestOrderDetails);
    }
}
