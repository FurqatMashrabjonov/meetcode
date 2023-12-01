<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CodeTemplate extends Model
{
    protected $fillable = [
        'programming_language_id',
        'name',
        'code',
    ];

public function programmingLanguage(): BelongsTo
{
        return $this->belongsTo(ProgrammingLanguage::class);
    }

}
