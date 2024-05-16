<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use App\Models\SatkerMaster;
use App\Models\UkerMaster;
use App\Models\User;
use Illuminate\Http\Request;

class UkerMasterController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $ukerMasters = UkerMaster::query()
            ->when($search, function ($query, $search) {
                $query->where('satker_master_kd_satker', 'like', '%'.$search.'%')
                    ->orWhere('nama_unit_kerja_eselon_2', 'like', '%'.$search.'%');
            })
            ->orderBy('nama_unit_kerja_eselon_2', 'asc')
            ->paginate(20); // Change 10 to the number of items you want per page

        return view('uker_masters.index', compact('ukerMasters'));
    }

    public function create()
    {
        $satkerMasters = SatkerMaster::all();
        return view('uker_masters.create', compact('satkerMasters'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'satker_master_kd_satker' => 'required|exists:satker_masters,kd_satker',
            'nama_unit_kerja_eselon_2' => 'required|string|max:255',
        ]);

        UkerMaster::create($request->all());

        return redirect()->route('uker_masters.index')
            ->with('success', 'Uker master created successfully.');
    }

    public function show(UkerMaster $ukerMaster)
    {
        $users = User::all();
        $facilities = Facility::all();
        return view('uker_masters.show', compact('ukerMaster','users','facilities'));
    }

    public function edit(UkerMaster $ukerMaster)
    {
        $satkerMasters = SatkerMaster::all();
        return view('uker_masters.edit', compact('ukerMaster','satkerMasters'));
    }

    public function update(Request $request, UkerMaster $ukerMaster)
    {
        $request->validate([
            'satker_master_kd_satker' => 'required|exists:satker_masters,kd_satker',
            'nama_unit_kerja_eselon_2' => 'required|string|max:255',
        ]);

        $ukerMaster->update($request->all());

        return redirect()->route('uker_masters.index')
            ->with('success', 'Uker master updated successfully');
    }

    public function destroy(UkerMaster $ukerMaster)
    {
        $ukerMaster->delete();

        return redirect()->route('uker_masters.index')
            ->with('success', 'Uker master deleted successfully');
    }
}