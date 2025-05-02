<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $password = Hash::make('111111');
        $adminRecords = [
                ['id' =>1, 'name' => 'Admin',
                 'type' => 'admin',
                 'mobile' => '1234567890',
                 'email' => 'admin@example.com',
                 'password' => $password,
                 'image' => '',
                 'status' => 1,
                 ],
                 ['id' =>2, 'name' => 'Sofia',
                 'type' => 'admin',
                 'mobile' => '1234567890',
                 'email' => 'admin2@example.com',
                 'password' => $password,
                 'image' => '',
                 'status' => 1,
                 ],
         ];
        Admin::insert($adminRecords);
        
    }
}
