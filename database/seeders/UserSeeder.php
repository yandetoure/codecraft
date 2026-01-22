<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Super Admin
        $superAdmin = User::firstOrCreate(
            ['email' => 'admin@codecraft.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );
        $superAdmin->assignRole('super_admin');

        // 2. Admin / Manager (Restricted permissions)
        $manager = User::firstOrCreate(
            ['email' => 'manager@codecraft.com'],
            [
                'name' => 'Manager Platform',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );
        $manager->assignRole('admin');

        // 3. Client 1 - Moussa Diop (La Teranga Restaurant)
        $client1 = User::firstOrCreate(
            ['email' => 'moussa@client.com'],
            [
                'name' => 'Moussa Diop',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );
        $client1->assignRole('client');

        // 4. Client 2 - Fatou Ndiaye (Dakar Delivers)
        $client2 = User::firstOrCreate(
            ['email' => 'fatou@client.com'],
            [
                'name' => 'Fatou Ndiaye',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );
        $client2->assignRole('client');

        $this->command->info('Users seeded successfully.');
        $this->command->info('Super Admin: admin@codecraft.com / password');
        $this->command->info('Manager: manager@codecraft.com / password');
        $this->command->info('Client 1: moussa@client.com / password');
        $this->command->info('Client 2: fatou@client.com / password');
    }
}
