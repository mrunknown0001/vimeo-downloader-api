<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('plans')->insert([
            [
                'name' => 'FREE',
                'description' => 'Free Tier Account with 200 points per month',
                'price' => 0.00,
                'points_per_month' => 200,
                'request_per_second' => 7,
            ],
            [
                'name' => 'PRO',
                'description' => 'PRO Tier Account with 100K points per month',
                'price' => 10,
                'points_per_month' => 100000,
                'request_per_second' => 7,
            ],
            [
                'name' => 'ULTRA',
                'description' => 'ULTRA Tier Account with 500K points per month',
                'price' => 32,
                'points_per_month' => 500000,
                'request_per_second' => 16,
            ],
            [
                'name' => 'MEGA',
                'description' => 'MEGA Tier Account with 1.5M points per month',
                'price' => 69,
                'points_per_month' => 1500000,
                'request_per_second' => 30,
            ],
        ]);
    }
}
