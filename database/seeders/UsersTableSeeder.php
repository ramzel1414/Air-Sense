<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;  // Import the Hash facade


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([

            //admin
            [
                'name' => 'Admin',
                'username' => 'admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('#admin123'),
                'role' => 'admin'    
            ],
            

            //user     
            [
                'name' => 'User',
                'username' => 'user',
                'email' => 'user@example.com',
                'password' => Hash::make('123'),
                'role' => 'user',
            ],
        ]);
    }
}
