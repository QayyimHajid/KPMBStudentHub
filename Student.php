<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Student extends Model
{
    protected $primaryKey = 'student_id';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'student_id',
        'user_id',
        'student_name',
        'programme',
        'semester',
        'phone_number',
        'email',
        'structure_id',
        'group_id',
        'home_address',
        'guardian_name',
        'guardian_relationship',
        'guardian_phone',
        'guardian_occupation',
        'guardian_employer',
        'profile_picture',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function repeatSubjectApplications(): HasMany
    {
        return $this->hasMany(RepeatSubjectApplication::class, 'student_id', 'student_id');
    }

    public function alternativeSubjectChoices(): HasMany
    {
        return $this->hasMany(StudentAlternativeSubjectChoice::class, 'student_id', 'student_id');
    }

    public function subjectRegistrations(): HasMany
    {
        return $this->hasMany(
            SubjectRegistration::class,
            'student_id',
            'student_id'
        );
    }

    public function programmeStructure(): BelongsTo
    {
        return $this->belongsTo(
            ProgrammeStructure::class,
            'structure_id',
            'structure_id'
        );
    }

    public function studentMarks(): HasMany
    {
        return $this->hasMany(
            StudentMark::class,
            'student_id',
            'student_id'
        );
    }

    public function academicResults(): HasMany
    {
        return $this->hasMany(
            AcademicResult::class,
            'student_id',
            'student_id'
        );
    }

    public function mentorAssignments(): HasMany
    {
        return $this->hasMany(
            StudentMentorAssignment::class,
            'student_id',
            'student_id'
        );
    }

    public function currentMentorAssignment(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(
            StudentMentorAssignment::class,
            'student_id',
            'student_id'
        )->whereNull('ended_at');
    }

    public function classGroup(): BelongsTo
    {
        return $this->belongsTo(
            ClassGroup::class,
            'group_id',
            'group_id'
        );
    }
}