<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudentMark extends Model
{
    protected $primaryKey = 'mark_id';

    protected $fillable = [
        'student_id',
        'subject_id',
        'class_id',
        'lecturer_id',
        'marks',
        'academic_session',
    ];

    protected function casts(): array
    {
        return [
            'marks' => 'decimal:2',
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

    public function classModel(): BelongsTo
    {
        return $this->belongsTo(
            ClassModel::class,
            'class_id',
            'class_id'
        );
    }

    public function lecturer(): BelongsTo
    {
        return $this->belongsTo(
            Lecturer::class,
            'lecturer_id',
            'lecturer_id'
        );
    }
}