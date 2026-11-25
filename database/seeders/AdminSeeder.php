<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin KursusKu',
            'email' => 'admin@kursusku.test',
            'password' => Hash::make('password123'),
            'role' => 'admin', 
        ]);
    }
}