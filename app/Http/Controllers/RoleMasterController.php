<?php

namespace App\Http\Controllers;

use App\Models\RoleMaster;
use App\Models\User;
use Illuminate\Http\Request;

class RoleMasterController extends Controller
{
    public function index(Request $request)
    {

        $search = $request->input('search');

        $roleMasters = RoleMaster::query()
            ->when($search, function ($query, $search) {
                $query->where('role_str', 'like', '%'.$search.'%')
                    ->orWhere('id', 'like', '%'.$search.'%');
            })
            ->orderBy('id', 'asc')
            ->paginate(20); // Change 10 to the number of items you want per page

        return view('role_masters.index', compact('roleMasters'));
    }

    public function create()
    {
        return view('role_masters.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'role_str' => 'required|string|max:255',
        ]);

        RoleMaster::create($request->all());

        return redirect()->route('role_masters.index')
            ->with('success', 'Role master created successfully.');
    }

    public function show(RoleMaster $roleMaster)
    {
        $users = User::all(); // Change 10 to the number of items you want per page;
        return view('role_masters.show', compact('roleMaster','users'));
    }

    public function edit(RoleMaster $roleMaster)
    {
        return view('role_masters.edit', compact('roleMaster'));
    }

    public function update(Request $request, RoleMaster $roleMaster)
    {
        $request->validate([
            'role_str' => 'required|string|max:255',
            'id' => 'required|unique:role_masters|max:999',
        ]);

        $roleMaster->update($request->all());

        return redirect()->route('role_masters.index')
            ->with('success', 'Role master updated successfully');
    }

    public function destroy(RoleMaster $roleMaster)
    {
        $roleMaster->delete();

        return redirect()->route('role_masters.index')
            ->with('success', 'Role master deleted successfully');
    }
}