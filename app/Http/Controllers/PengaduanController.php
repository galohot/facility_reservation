<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Illuminate\Http\Request;

class PengaduanController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $pengaduans = Pengaduan::query()
            ->when($search, function ($query, $search) {
                $query
                    ->where('title', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%')
                    ->orWhere('id', 'like', '%' . $search . '%');
            })
            ->orderBy('id', 'asc')
            ->paginate(20); // Change 20 to the number of items you want per page

        return view('pengaduans.index', compact('pengaduans'));
    }

    public function create()
    {
        return view('pengaduans.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'phone_number' => 'required',
            'email' => 'required|string|email',
            'is_active' => 'required|boolean',
        ]);

        Pengaduan::create($request->all());

        return redirect()->route('pengaduans.index')->with('success', 'Pengaduan created successfully.');
    }

    public function show(Pengaduan $pengaduan)
    {
        return view('pengaduans.show', compact('pengaduan'));
    }

    public function edit(Pengaduan $pengaduan)
    {
        return view('pengaduans.edit', compact('pengaduan'));
    }

    public function update(Request $request, Pengaduan $pengaduan)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'phone_number' => 'required',
            'email' => 'required|string|email',
            'is_active' => 'required|boolean',
        ]);

        $pengaduan->update($request->all());

        return redirect()->route('pengaduans.index')->with('success', 'Pengaduan updated successfully');
    }

    public function destroy(Pengaduan $pengaduan)
    {
        $pengaduan->delete();

        return redirect()->route('pengaduans.index')->with('success', 'Pengaduan deleted successfully');
    }
}