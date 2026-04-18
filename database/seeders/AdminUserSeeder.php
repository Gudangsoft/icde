<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@icde.id'],
            [
                'name'     => 'Administrator ICDE',
                'email'    => 'admin@icde.id',
                'password' => Hash::make('Admin@ICDE2024'),
                'role'     => 'admin',
            ]
        );
    }
}
