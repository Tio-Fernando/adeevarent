<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'administrator',
            'email' => 'admin@gmail.com',
            'password'=> Hash::make('admin123'),
            'phone' => '082561781',
            'status' => true,
            'level' => 'Administrator'
        ]
        );
        User::create([
            'name' => 'Pak Umar',
            'email' => 'superAdmin@gmail.com',
            'password'=> Hash::make('clientBaik'),
            'phone' => '082561781',
            'status' => true,
            'level' => 'SuperAdmin'
        ]
        );
    }
}
