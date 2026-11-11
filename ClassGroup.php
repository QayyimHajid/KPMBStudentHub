<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ClassGroup extends Model
{
    protected $table = 'class_groups';

    protected $primaryKey = 'group_id';

    protected $fillable = [
        'group_name',
        'programme_id',
        'semester',
        'academic_session',
    ];

    protected $casts = [
        'semester' => 'integer',
    ];

    public function programme(): BelongsTo
    {
        return $this->belongsTo(
            Programme::class,
            'programme_id',
            'programme_id'
        );
    }

    public function students(): HasMany
    {
        return $this->hasMany(
            Student::class,
            'group_id',
            'group_id'
        );
    }

    public function classes(): HasMany
    {
        return $this->hasMany(
            ClassModel::class,
            'group_id',
            'group_id'
        );
    }
}