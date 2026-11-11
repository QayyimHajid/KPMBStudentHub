<?php

namespace App\Http\Controllers;

use App\Models\CampusFacility;

class CampusMapController extends Controller
{
    public function index()
    {
        $facilities = CampusFacility::orderBy('facility_name')->get();

        $mappedFacilities = CampusFacility::query()
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->orderBy('facility_name')
            ->get()
            ->map(function ($facility) {
                return [
                    'name' => $facility->facility_name,
                    'type' => $facility->facility_type,
                    'location' => $facility->location,
                    'latitude' => $facility->latitude,
                    'longitude' => $facility->longitude,
                ];
            })
            ->values();

        return view('campus-map.index', compact(
            'facilities',
            'mappedFacilities'
        ));
    }
}
