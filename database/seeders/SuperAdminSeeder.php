<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Using raw SQL as per requirements.
     */
    public function run(): void
    {
        // Check if SuperAdmin already exists
        $existingSuperAdmin = DB::table('users')
            ->where('email', 'superadmin@example.com')
            ->first();

        if ($existingSuperAdmin) {
            $this->command->info('SuperAdmin already exists. Skipping...');
            return;
        }

        // Create SuperAdmin using raw SQL
        DB::statement("
            INSERT INTO users (name, email, password, role, company_id, created_at, updated_at)
            VALUES (?, ?, ?, ?, ?, ?, ?)
        ", [
            'Super Admin',
            'superadmin@example.com',
            Hash::make('password'),
            'superadmin',
            null,
            now(),
            now(),
        ]);

        $this->command->info('SuperAdmin created successfully!');
        $this->command->info('Email: superadmin@example.com');
        $this->command->info('Password: password');
    }
}
