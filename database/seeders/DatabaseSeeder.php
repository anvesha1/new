<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        {
            // Create roles
            Role::create(['name' => 'admin']);
            Role::create(['name' => 'manager']);
            Role::create(['name' => 'team_member']);

            // Create a user with the admin role
            $adminUser = User::create([
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => bcrypt('password'), // Use a secure password
            ]);

            $adminRole = Role::where('name', 'admin')->first();
            $adminUser->roles()->attach($adminRole);

            // Other seeding logic...
        }
    }
}
