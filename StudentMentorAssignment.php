<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\LecturerDirectory;

class StudentMentorAssignment extends Model
{
    protected $primaryKey = 'assignment_id';

    protected $fillable = [
        'student_id',
        'lecturer_id',
        'lecturer_directory_id',
        'assigned_by',
        'assigned_at',
        'ended_at',
    ];

    protected function casts(): array
    {
        return [
            'assigned_at' => 'date',
            'ended_at' => 'date',
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

    public function assignedBy(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'assigned_by',
            'id'
        );
    }
}
