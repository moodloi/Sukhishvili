<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class SuperAdminSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Super Admin',
            'email' => 'admin@admin.com',
            'password' => '$2y$12$VReTCYu0q9V4njXH.CiN0O0zVJNU4Inm6Xbyi879EPPPtu5yve12G',
            'created_at' => '2024-09-19 00:35:54',
            'updated_at' => '2024-09-19 00:35:54',
        ]);
    }
}
