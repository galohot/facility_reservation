<?php

namespace App\Http\Controllers;

use App\Models\SatkerMaster;
use App\Models\UkerMaster;
use Illuminate\Http\Request;

class SatkerMasterController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $satkerMasters = SatkerMaster::query()
            ->when($search, function ($query, $search) {
                $query->where('kd_satker', 'like', '%'.$search.'%')
                    ->orWhere('nama_satker', 'like', '%'.$search.'%');
            })
            ->orderBy('nama_satker', 'asc')
            ->paginate(20); // Change 10 to the number of items you want per page

        return view('satker_masters.index', compact('satkerMasters'));
    }


    public function create()
    {
        return view('satker_masters.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kd_satker' => 'required|unique:satker_masters',
            'nama_satker' => 'required|string|max:255',
            // Add other validation rules as needed for other fields
        ]);

        SatkerMaster::create($request->all());

        return redirect()->route('satker_masters.index')
            ->with('success', 'Satker master created successfully.');
    }

    public function show(SatkerMaster $satkerMaster)
    {
        $ukerMasters = UkerMaster::all();
        return view('satker_masters.show', compact('satkerMaster','ukerMasters'));
    }

    public function edit(SatkerMaster $satkerMaster)
    {
        return view('satker_masters.edit', compact('satkerMaster'));
    }

    public function update(Request $request, SatkerMaster $satkerMaster)
    {

        $request->validate([
            'kd_satker' => 'required|unique:satker_masters,kd_satker,' . $satkerMaster->id,
            'nama_satker' => 'required|string|max:255',
            // Add other validation rules as needed for other fields
        ]);

        $satkerMaster->update($request->all());

        return redirect()->route('satker_masters.index')
            ->with('success', 'Satker master updated successfully');
    }

    public function destroy(SatkerMaster $satkerMaster)
    {
        $satkerMaster->delete();

        return redirect()->route('satker_masters.index')
            ->with('success', 'Satker master deleted successfully');
    }
}