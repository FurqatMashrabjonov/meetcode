<?php

namespace Database\Seeders;

use App\Models\CodeTemplate;
use App\Models\ProgrammingLanguage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CodeTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $templates = [
            [
                'name' => 'Javascript 1-D Massiv uchun shablon',
                'programming_language_id' => ProgrammingLanguage::query()->where('extension', 'js')->first()->id,
                'code' => <<<EOF
const fs = require('fs');
const data = fs.readFileSync('input.txt', 'utf8');
let arr = data.split('\n')
let param = []
arr.forEach(a => param.push(a.split('').map(item => parseInt(item))))

{{code}}

const res = draw(param)
fs.writeFileSync('output.txt', JSON.stringify(res), 'utf8');
EOF

            ],
        ];
        CodeTemplate::query()->insert($templates);
    }
}
