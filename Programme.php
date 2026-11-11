<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Programme extends Model
{
    protected $table = 'programmes';

    protected $primaryKey = 'programme_id';

    protected $fillable = [
        'programme_code',
        'programme_name',
        'status',
    ];

    public function programmeStructures(): HasMany
    {
        return $this->hasMany(
            ProgrammeStructure::class,
            'programme_id',
            'programme_id'
        );
    }
}
