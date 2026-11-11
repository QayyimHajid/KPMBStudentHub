<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProgrammeStructure extends Model
{
    protected $table = 'programme_structures';

    protected $primaryKey = 'structure_id';

    protected $fillable = [
        'programme_id',
        'intake_code',
        'version',
        'status',
        'requires_pb_eligibility',
        'has_industrial_training',
        'industrial_training_semester',
    ];

    protected function casts(): array
    {
        return [
            'version' => 'integer',
            'requires_pb_eligibility' => 'boolean',
            'has_industrial_training' => 'boolean',
            'industrial_training_semester' => 'integer',
        ];
    }

    public function programme(): BelongsTo
    {
        return $this->belongsTo(Programme::class, 'programme_id', 'programme_id');
    }

    public function students(): HasMany
    {
        return $this->hasMany(Student::class, 'structure_id', 'structure_id');
    }

    public function structureSubjects(): HasMany
    {
        return $this->hasMany(ProgrammeStructureSubject::class, 'structure_id', 'structure_id');
    }
}
