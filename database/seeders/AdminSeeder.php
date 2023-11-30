<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = \App\Models\User::factory()->create([
            'name' => 'Furqat Mashrabjonov',
            'email' => 'php_lesson@mail.ru',
            'password' => bcrypt('admin12345'),
            'role' => UserRole::ADMIN,
            'email_verified_at' => now(),
        ]);
    }
}
