<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AlternativeSubjectGroup extends Model
{
    protected $table = 'alternative_subject_groups';
    protected $primaryKey = 'alternative_group_id';

    protected $fillable = [
        'structure_id', 'semester', 'group_code', 'group_name', 'description',
    ];

    protected $casts = ['semester' => 'integer'];

    public function programmeStructure(): BelongsTo
    {
        return $this->belongsTo(ProgrammeStructure::class, 'structure_id', 'structure_id');
    }

    public function subjectMappings(): HasMany
    {
        return $this->hasMany(ProgrammeStructureSubject::class, 'alternative_group_id', 'alternative_group_id');
    }

    public function studentChoices(): HasMany
    {
        return $this->hasMany(StudentAlternativeSubjectChoice::class, 'alternative_group_id', 'alternative_group_id');
    }
}
