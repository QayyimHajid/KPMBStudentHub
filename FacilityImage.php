<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FacilityImage extends Model
{
    protected $primaryKey = 'image_id';

    protected $fillable = [
        'facility_id',
        'image_path',
        'is_primary',
        'sort_order',
    ];

    protected $casts = [
        'is_primary' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function facility(): BelongsTo
    {
        return $this->belongsTo(CampusFacility::class, 'facility_id', 'facility_id');
    }
}
