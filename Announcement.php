<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $primaryKey = 'announcement_id';

    protected $fillable = [
        'title',
        'content',
        'date_published',
        'status',
        'image_path',
    ];

    protected function casts(): array
    {
        return [
            'date_published' => 'date',
        ];
    }
}