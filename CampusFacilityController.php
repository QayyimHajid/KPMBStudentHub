<?php

namespace App\Http\Controllers;

use App\Models\CampusFacility;
use Illuminate\Http\Request;

class CampusFacilityController extends Controller
{
    public function index(Request $request)
    {
        $search = trim((string) $request->query('search', ''));
        $category = trim((string) $request->query('category', ''));

        $categories = CampusFacility::query()
            ->select('facility_type')
            ->distinct()
            ->orderBy('facility_type')
            ->pluck('facility_type');

        $facilities = CampusFacility::query()
            ->with(['images' => function ($query) {
                $query->orderByDesc('is_primary')->orderBy('sort_order');
            }])
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($subQuery) use ($search) {
                    $subQuery->where('facility_name', 'like', "%{$search}%")
                        ->orWhere('facility_type', 'like', "%{$search}%")
                        ->orWhere('location', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%");
                });
            })
            ->when($category !== '' && $category !== 'all', function ($query) use ($category) {
                $query->where('facility_type', $category);
            })
            ->orderBy('facility_name')
            ->paginate(9)
            ->withQueryString();

        return view('facilities.index', compact('facilities', 'search', 'category', 'categories'));
    }
}
