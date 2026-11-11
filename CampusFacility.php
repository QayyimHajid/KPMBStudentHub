<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CampusFacility extends Model
{
    protected $primaryKey = 'facility_id';

    protected $fillable = [
        'facility_name',
        'facility_type',
        'location',
        'description',
        'operating_hours',
    ];

    public function images(): HasMany
    {
        return $this->hasMany(FacilityImage::class, 'facility_id', 'facility_id')
            ->orderBy('sort_order');
    }
}
    