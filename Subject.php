<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Subject extends Model
{
    protected $primaryKey = 'subject_id';

    protected $fillable = [
        'subject_code',
        'subject_name',
        'credit_hour',
        'semester',
        'status',
        'coordinator_lecturer_id',
    ];


    public function coordinatorLecturer(): BelongsTo
    {
        return $this->belongsTo(
            Lecturer::class,
            'coordinator_lecturer_id',
            'lecturer_id'
        );
    }

    public function classes(): HasMany
    {
        return $this->hasMany(ClassModel::class, 'subject_id', 'subject_id');
    }

    public function subjectRegistrations(): HasMany
    {
        return $this->hasMany(
            SubjectRegistration::class,
            'subject_id',
            'subject_id'
        );
    }

    public function studentMarks(): HasMany
    {
        return $this->hasMany(StudentMark::class, 'subject_id', 'subject_id');
    }

    public function academicResults(): HasMany
    {
        return $this->hasMany(
            AcademicResult::class,
            'subject_id',
            'subject_id'
        );
    }
}