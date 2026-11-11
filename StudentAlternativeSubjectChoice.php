<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudentAlternativeSubjectChoice extends Model
{
    protected $table = 'student_alternative_subject_choices';
    protected $primaryKey = 'choice_id';

    protected $fillable = ['student_id', 'alternative_group_id', 'subject_id'];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class, 'student_id', 'student_id');
    }

    public function alternativeGroup(): BelongsTo
    {
        return $this->belongsTo(AlternativeSubjectGroup::class, 'alternative_group_id', 'alternative_group_id');
    }

    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class, 'subject_id', 'subject_id');
    }
}
