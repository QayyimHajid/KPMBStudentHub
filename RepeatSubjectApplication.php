<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RepeatSubjectApplication extends Model
{
    protected $table = 'repeat_subject_applications';
    protected $primaryKey = 'repeat_application_id';

    protected $fillable = [
        'student_id',
        'subject_id',
        'class_id',
        'structure_id',
        'student_current_semester',
        'subject_semester',
        'academic_session',
        'eligibility_basis',
        'eligibility_grade',
        'pb_percentage',
        'application_status',
        'reviewed_by',
        'remarks',
        'submitted_at',
        'reviewed_at',
    ];

    protected function casts(): array
    {
        return [
            'student_current_semester' => 'integer',
            'subject_semester' => 'integer',
            'pb_percentage' => 'decimal:2',
            'submitted_at' => 'datetime',
            'reviewed_at' => 'datetime',
        ];
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class, 'student_id', 'student_id');
    }

    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class, 'subject_id', 'subject_id');
    }

    public function classModel(): BelongsTo
    {
        return $this->belongsTo(ClassModel::class, 'class_id', 'class_id');
    }

    public function programmeStructure(): BelongsTo
    {
        return $this->belongsTo(ProgrammeStructure::class, 'structure_id', 'structure_id');
    }

    public function reviewer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reviewed_by', 'id');
    }
}
