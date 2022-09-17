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
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'MD. MUTASIM NAIB',
            'email' => 'super@gmail.com',
            'phone' => '01724698392',
            'user_role' => 1,
            'user_image' => 'public/user_images/1661942640.jpg',
            'address' => 'Dhaka',
            'password' => Hash::make('123456789'),
        ]);
    }
}
