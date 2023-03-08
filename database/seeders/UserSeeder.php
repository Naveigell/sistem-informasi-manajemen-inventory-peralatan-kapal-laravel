<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
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
        User::create([
            "name" => "Admin Bali Test",
            "email" => "admin.bali@gmail.com",
            "password" => 123456,
            "role" => User::ROLE_ADMIN,
        ]);

        User::create([
            "name" => "Admin Ambon Test",
            "email" => "admin.ambon@gmail.com",
            "password" => 123456,
            "role" => User::ROLE_ADMIN,
        ]);

        User::create([
            "name" => "Director Test",
            "email" => "director@gmail.com",
            "password" => 123456,
            "role" => User::ROLE_COMPANY_DIRECTOR,
        ]);
    }
}
