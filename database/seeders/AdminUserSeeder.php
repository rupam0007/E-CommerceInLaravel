<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $email = 'admin@nexora.com';

        $user = Admin::firstOrCreate(
            ['email' => $email],
            [
                'name' => 'Admin User',
                'password' => Hash::make('Admin@123456'),
            ]
        );

        $this->command?->info("Admin user available: {$user->email} / Admin@123456");
    }
}
