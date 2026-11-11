<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProgrammeStructureSubject extends Model
{
    protected $table = 'programme_structure_subjects';

    protected $primaryKey = 'structure_subject_id';

    protected $fillable = [
        'structure_id',
        'subject_id',
        'semester',
        'alternative_group_id',
    ];

    protected function casts(): array
    {
        return [
            'semester' => 'integer',
        ];
    }

    public function programmeStructure(): BelongsTo
    {
        return $this->belongsTo(
            ProgrammeStructure::class,
            'structure_id',
            'structure_id'
        );
    }

    public function alternativeGroup(): BelongsTo
    {
        return $this->belongsTo(AlternativeSubjectGroup::class, 'alternative_group_id', 'alternative_group_id');
    }

    public function subject(): BelongsTo
    {
        return $this->belongsTo(
            Subject::class,
            'subject_id',
            'subject_id'
        );
    }
}
