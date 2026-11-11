<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SubjectRegistration extends Model
{
    protected $primaryKey = 'registration_id';

    protected $fillable = [
        'application_id',
        'registration_type',
        'repeat_application_id',
        'student_id',
        'subject_id',
        'class_id',
        'semester',
        'registration_date',
        'registration_status',
    ];

    protected function casts(): array
    {
        return [
            'semester' => 'integer',
            'registration_date' => 'date',
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

    public function repeatApplication(): BelongsTo
    {
        return $this->belongsTo(RepeatSubjectApplication::class, 'repeat_application_id', 'repeat_application_id');
    }

    public function application(): BelongsTo
    {
        return $this->belongsTo(
            SubjectRegistrationApplication::class,
            'application_id',
            'application_id'
        );
    }
}