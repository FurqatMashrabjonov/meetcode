<?php

namespace Database\Seeders;

use App\Models\ProgrammingLanguage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProgrammingLanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $langs = [
            [
                'name' => 'Python',
                'extension' => 'py',
                'version' => '3.11.4',
                'run_command' => 'python3',
            ],
            [
                'name' => 'PHP',
                'extension' => 'php',
                'version' => '8.2',
                'run_command' => 'php',
            ],
            [
                'name' => 'JavaScript',
                'extension' => 'js',
                'version' => '16.9.1',
                'run_command' => 'node',
            ]
        ];

        ProgrammingLanguage::query()->insert($langs);
    }
}
