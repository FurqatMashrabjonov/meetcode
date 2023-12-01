<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
//         \App\Models\User::factory(100)->create();
//        $this->call(AdminSeeder::class);
//        $this->call(ProgrammingLanguageSeeder::class);
        $this->call(CodeTemplateSeeder::class);
    }
}
