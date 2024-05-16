<?php

namespace App\Http\Controllers;

use App\Models\FacilityAddon;
use Illuminate\Http\Request;

class FacilityAddonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $facilityAddons = FacilityAddon::all();
        return view('facility_addons.index', compact('facilityAddons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('facility_addons.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'facility_id' => 'required|exists:facilities,id',
            'facility_addons' => 'required|string',
        ]);

        FacilityAddon::create($request->all());

        return redirect()->route('facility_addons.index')->with('success', 'Facility addon created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(FacilityAddon $facilityAddon)
    {
        return view('facility_addons.show', compact('facilityAddon'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FacilityAddon $facilityAddon)
    {
        return view('facility_addons.edit', compact('facilityAddon'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FacilityAddon $facilityAddon)
    {
        $request->validate([
            'facility_id' => 'required|exists:facilities,id',
            'facility_addons' => 'required|string',
        ]);

        $facilityAddon->update($request->all());

        return redirect()->route('facility_addons.index')->with('success', 'Facility addon updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FacilityAddon $facilityAddon)
    {
        $facilityAddon->delete();

        return redirect()->route('facility_addons.index')->with('success', 'Facility addon deleted successfully.');
    }
}