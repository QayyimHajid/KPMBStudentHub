<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SubjectRegistrationApplication extends Model
{
    protected $primaryKey = 'application_id';

    protected $fillable = [
        'student_id',
        'semester',
        'academic_session',
        'application_status',
        'submitted_at',
        'reviewed_by',
        'reviewed_at',
        'remarks',
    ];

    protected function casts(): array
    {
        return [
            'semester' => 'integer',
            'submitted_at' => 'datetime',
            'reviewed_at' => 'datetime',
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

    public function registrations(): HasMany
    {
        return $this->hasMany(
            SubjectRegistration::class,
            'application_id',
            'application_id'
        );
    }
}