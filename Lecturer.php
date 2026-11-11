<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Lecturer extends Model
{
    protected $primaryKey = 'lecturer_id';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'lecturer_id',
        'user_id',
        'lecturer_name',
        'department',
        'email',
        'phone_number',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function classes(): HasMany
    {
        return $this->hasMany(ClassModel::class, 'lecturer_id', 'lecturer_id');
    }

    public function coordinatorSubjects(): HasMany
    {
        return $this->hasMany(
            Subject::class,
            'coordinator_lecturer_id',
            'lecturer_id'
        );
    }

    public function studentMarks(): HasMany
    {
        return $this->hasMany(StudentMark::class, 'lecturer_id', 'lecturer_id');
    }

        public function mentorAssignments(): HasMany
    {
        return $this->hasMany(
            StudentMentorAssignment::class,
            'lecturer_id',
            'lecturer_id'
        );
    }
}