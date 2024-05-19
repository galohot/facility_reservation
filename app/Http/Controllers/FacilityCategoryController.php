<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use App\Models\FacilityCategory;
use Illuminate\Http\Request;

class FacilityCategoryController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $facilityCategories = FacilityCategory::query()
        ->when($search, function ($query, $search) {
            $query->where('category_str', 'like', '%'.$search.'%');
        })
        ->orderBy('created_at', 'desc')
        ->paginate(20);

        return view('facility_categories.index', compact('facilityCategories'));
    }

    public function create()
    {
        return view('facility_categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_str' => 'required|string|max:255',
        ]);

        FacilityCategory::create($request->all());

        return redirect()->route('facility_categories.index')
            ->with('success', 'Facility category created successfully.');
    }

    public function show(FacilityCategory $facilityCategory)
    {
        $facilities = Facility::all();
        return view('facility_categories.show', compact('facilities','facilityCategory'));
    }
    public function landingShow(FacilityCategory $facilityCategory)
    {
        $facilities = Facility::all();
        return view('landing.content.facility.show', compact('facilities','facilityCategory'));
    }

    public function edit(FacilityCategory $facilityCategory)
    {
        return view('facility_categories.edit', compact('facilityCategory'));
    }

    public function update(Request $request, FacilityCategory $facilityCategory)
    {
        $request->validate([
            'category_str' => 'required|string|max:255',
        ]);

        $facilityCategory->update($request->all());

        return redirect()->route('facility_categories.index')
            ->with('success', 'Facility category updated successfully');
    }

    public function destroy(FacilityCategory $facilityCategory)
    {
        $facilityCategory->delete();

        return redirect()->route('facility_categories.index')
            ->with('success', 'Facility category deleted successfully');
    }

}