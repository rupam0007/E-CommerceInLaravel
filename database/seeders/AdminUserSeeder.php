<?php

namespace Database\Seeders;

use App\Models\User;
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

        $user = User::firstOrCreate(
            ['email' => $email],
            [
                'name' => 'Admin User',
                'password' => Hash::make('Admin@123456'),
                'phone' => '0000000000',
                'address' => 'Admin Street 1',
                'city' => 'Admin City',
                'state' => 'Admin State',
                'postal_code' => '000000',
                'country' => 'Adminland',
            ]
        );

        $this->command?->info("Admin user available: {$user->email} / Admin@123456");
    }
}
