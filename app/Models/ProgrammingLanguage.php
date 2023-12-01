<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgrammingLanguage extends Model
{
    protected $fillable = [
        'name',
        'extension',
        'version',
        'run_command',
    ];
}
