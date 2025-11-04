<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Super Admin',
                'email' => 'superadmin@localhost',
                'password' => bcrypt('password'),
                'role' => 'superadmin',
            ],
            [
                'name' => 'User One',
                'email' => 'userone@localhost',
                'password' => bcrypt('password'),
                'role' => 'user'
            ]
        ]);
    }
}
