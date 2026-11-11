<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClassTimetable extends Model
{
    protected $primaryKey = 'timetable_id';

    protected $fillable = [
        'class_id',
        'day',
        'start_time',
        'end_time',
        'venue',
    ];

    protected function casts(): array
    {
        return [
            'start_time' => 'datetime:H:i',
            'end_time' => 'datetime:H:i',
        ];
    }

    public function classModel(): BelongsTo
    {
        return $this->belongsTo(
            ClassModel::class,
            'class_id',
            'class_id'
        );
    }
}