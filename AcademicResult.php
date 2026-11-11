<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AcademicResult extends Model
{
    protected $primaryKey = 'result_id';

    protected $fillable = [
        'student_id',
        'subject_id',
        'semester',
        'grade',
        'grade_point',
        'academic_session',
    ];

    protected function casts(): array
    {
        return [
            'semester' => 'integer',
            'grade_point' => 'decimal:2',
        ];
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(
            Student::class,
            'student_id',
            'student_id'
        );
    }

    public function subject(): BelongsTo
    {
        return $this->belongsTo(
            Subject::class,
            'subject_id',
            'subject_id'
        );
    }
}