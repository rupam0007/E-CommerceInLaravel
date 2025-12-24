<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * 
     * To create a new admin user, run:
     * php artisan db:seed --class=AdminUserSeeder
     * 
     * You can modify the email, name, and password below before running.
     */
    public function run(): void
    {
        // Modify these values to create your admin account
        $email = 'admin@nexora.com';
        $name = 'Admin User';
        $password = 'Admin@123456';

        $admin = Admin::firstOrCreate(
            ['email' => $email],
            [
                'name' => $name,
                'password' => Hash::make($password),
            ]
        );

        if ($admin->wasRecentlyCreated) {
            $this->command?->info("✓ Admin user created successfully!");
            $this->command?->info("  Email: {$email}");
            $this->command?->info("  Password: {$password}");
        } else {
            $this->command?->info("✓ Admin user already exists: {$email}");
        }
    }
}
