<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProblemCategory extends Model
{

    protected $fillable = [
        'name',
        'slug',
        'description',
        'status',
    ];

}
