<?php

namespace Database\Seeders;

use App\Models\Alert;
use App\Models\Honeypot;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class HoneywatchSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Leila Admin',
            'email' => 'admin@honeywatch.local',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        Honeypot::create([
            'name' => 'Fake Admin Login',
            'type' => 'login',
            'url_slug' => 'admin',
            'is_active' => true,
            'user_id' => $admin->id,
        ]);

        Honeypot::create([
            'name' => 'Fake WordPress',
            'type' => 'login',
            'url_slug' => 'wp-admin',
            'is_active' => true,
            'user_id' => $admin->id,
        ]);

        Alert::create([
            'user_id' => $admin->id,
            'threshold' => 10,
            'email_sent' => false,
        ]);
    }
}