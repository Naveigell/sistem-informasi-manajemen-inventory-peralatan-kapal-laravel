<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (config('app.env') == 'development') {
            User::create([
                "name" => "Admin Bali Test",
                "email" => "admin.bali@gmail.com",
                "password" => 123456,
                "role" => User::ROLE_ADMIN,
                "placed_in" => User::PLACED_IN_BALI,
            ]);

            User::create([
                "name" => "Admin Ambon Test",
                "email" => "admin.ambon@gmail.com",
                "password" => 123456,
                "role" => User::ROLE_ADMIN,
                "placed_in" => User::PLACED_IN_AMBON,
            ]);
        }

        User::create([
            "name" => "Director Test",
            "email" => "director@gmail.com",
            "password" => 123456,
            "role" => User::ROLE_COMPANY_DIRECTOR,
            "placed_in" => Arr::random([User::PLACED_IN_AMBON, User::PLACED_IN_BALI]),
        ]);
    }
}
