<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Problem extends Model
{
    protected $fillable = [
        'problem_category_id',
        'slug',
        'title',
        'description',
        'starter_code',
        'image',
        'status',
    ];

    public function problemCategory(): BelongsTo
    {
        return $this->belongsTo(ProblemCategory::class);
    }

    public function inputs(): HasMany
    {
        return $this->hasMany(ProblemInput::class);
    }

    public function outputs(): HasMany
    {
        return $this->hasMany(ProblemOutput::class);
    }
}
