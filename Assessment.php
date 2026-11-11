<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Assessment extends Model
{
    protected $primaryKey = 'assessment_id';

    protected $fillable = [
        'scheme_id',
        'assessment_name',
        'assessment_type',
        'max_marks',
        'weight_percentage',
        'sort_order',
        'description',
    ];

    protected function casts(): array
    {
        return [
            'max_marks' => 'decimal:2',
            'weight_percentage' => 'decimal:2',
            'sort_order' => 'integer',
        ];
    }

    public function scheme(): BelongsTo
    {
        return $this->belongsTo(AssessmentScheme::class, 'scheme_id', 'scheme_id');
    }

    public function marks(): HasMany
    {
        return $this->hasMany(AssessmentMark::class, 'assessment_id', 'assessment_id');
    }
}
