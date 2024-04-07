<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('id_ID');
        $suppliers = [];

        foreach (range(1, 25) as $item) {
            $suppliers[] = [
                "name"          => $faker->country . '-' . $faker->countryCode,
                "city"          => $faker->city,
                "payment_type"  => Arr::random([Supplier::PAYMENT_TYPE_CASH, Supplier::PAYMENT_TYPE_TRANSFER]),
                "phone"         => $faker->unique()->numerify("08##########"),
                "operator_name" => $faker->name,
                "created_at"    => now()->toDateTimeString(),
                "updated_at"    => now()->toDateTimeString(),
            ];
        }

        Supplier::insert($suppliers);
    }
}
