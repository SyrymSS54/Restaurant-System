<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'syrym',
            'email' => 'syrym@gmail.com',
            'password' => Hash::make('qwerty'),
            'is_admin' => False
        ]);
        DB::table('users')->insert([
            'name' => 'syrym_admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('qwerty'),
            'is_admin' => True
        ]);
    }
}
