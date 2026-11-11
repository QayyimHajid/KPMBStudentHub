<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $primaryKey = 'event_id';

    protected $fillable = [
        'event_name',
        'description',
        'event_date',
        'start_time',
        'end_time',
        'venue',
        'image_path',
    ];

    protected function casts(): array
    {
        return [
            'event_date' => 'date',
        ];
    }
}
