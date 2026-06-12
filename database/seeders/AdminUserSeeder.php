<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::query()->updateOrCreate(
            ['email' => env('ADMIN_EMAIL', 'admin@grebles.local')],
            [
                'name' => env('ADMIN_NAME', 'Grebles Admin'),
                'password' => env('ADMIN_PASSWORD', 'ChangeMe!2026'),
                'role' => User::ROLE_ADMIN,
                'email_verified_at' => now(),
                'is_active' => true,
            ],
        );
    }
}
