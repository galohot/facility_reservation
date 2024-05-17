<?php

namespace App\Http\Controllers;

use App\Models\Addon;
use Illuminate\Http\Request;

class AddonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $addons = Addon::all();
        return view('addons.index', compact('addons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('addons.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'addon_str' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $data = $request->all();
        Addon::create($data);

        return redirect()->route('addons.index')
            ->with('success', 'Addon created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Addon $addon)
    {
        return view('addons.show', compact('addon'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Addon $addon)
    {
        return view('addons.edit', compact('addon'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Addon $addon)
    {
        $request->validate([
            'addon_str' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $data = $request->all();
        $addon->update($data);

        return redirect()->route('addons.index')
            ->with('success', 'Addon updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Addon $addon)
    {
        $addon->delete();
        return redirect()->route('addons.index')
            ->with('success', 'Addon deleted successfully.');
    }
}