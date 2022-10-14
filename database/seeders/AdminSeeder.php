<?php

namespace Database\Seeders;

use App\Models\Admin;
use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker = Faker::create();

        Admin::create([
            'name' => $faker->name,
            'email' => 'admin@warehouse.co.ke',
            'phone_no' => '0721000000',
            'password' => bcrypt('password')
        ]);
    }
}
