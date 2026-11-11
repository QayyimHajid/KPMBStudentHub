<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AssessmentScheme extends Model
{
    protected $primaryKey = 'scheme_id';

    protected $fillable = [
        'subject_id',
        'academic_session',
        'status',
        'notes',
    ];

    public function casts(): array
    {
        return [];
    }

    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class, 'subject_id', 'subject_id');
    }

    public function assessments(): HasMany
    {
        return $this->hasMany(Assessment::class, 'scheme_id', 'scheme_id')
            ->orderBy('sort_order');
    }
}
