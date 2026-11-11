<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LecturerDirectory extends Model
{
    protected $table = 'lecturer_directory';

    protected $fillable = [
        'lecturer_name',
        'position',
        'department_code',
        'department',
        'email',
        'photo_path',
    ];

    public function classes(): HasMany
    {
        return $this->hasMany(
            ClassModel::class,
            'lecturer_directory_id',
            'id'
        );
    }
}
