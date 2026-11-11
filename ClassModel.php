<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ClassModel extends Model
{
    protected $table = 'classes';

    protected $primaryKey = 'class_id';

    protected $fillable = [
        'subject_id',
        'lecturer_id',
        'lecturer_directory_id',
        'class_name',
        'semester',
        'academic_session',
        'group_id',
        'class_type',
        'structure_id',
    ];

    public function subject(): BelongsTo
    {
        return $this->belongsTo(
            Subject::class,
            'subject_id',
            'subject_id'
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

    public function lecturerDirectory(): BelongsTo
    {
        return $this->belongsTo(
            LecturerDirectory::class,
            'lecturer_directory_id',
            'id'
        );
    }

    public function subjectRegistrations(): HasMany
    {
        return $this->hasMany(
            SubjectRegistration::class,
            'class_id',
            'class_id'
        );
    }

    public function studentMarks(): HasMany
    {
        return $this->hasMany(
            StudentMark::class,
            'class_id',
            'class_id'
        );
    }

    public function classTimetables(): HasMany
    {
        return $this->hasMany(
            ClassTimetable::class,
            'class_id',
            'class_id'
        );
    }

    public function programmeStructure(): BelongsTo
    {
        return $this->belongsTo(ProgrammeStructure::class, 'structure_id', 'structure_id');
    }

    public function repeatApplications(): HasMany
    {
        return $this->hasMany(RepeatSubjectApplication::class, 'class_id', 'class_id');
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