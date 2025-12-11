<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        User::updateOrCreate(
            ['email' => 'admin@mppsi.com'],
            [
                'name' => 'Admin Utama',
                'password' => Hash::make('123456'),
                'role' => 'admin',
            ]
        );
    }
}
