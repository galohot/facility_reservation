<?php

namespace App\Http\Controllers;

use App\Models\RoleMaster;
use App\Models\SatkerMaster;
use App\Models\UkerMaster;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $role = $request->input('role');

        $users = User::query()
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', '%'.$search.'%')
                      ->orWhere('email', 'like', '%'.$search.'%')
                      ->orWhereHas('roleMaster', function ($roleMasterQuery) use ($search) {
                        $roleMasterQuery->where('role_str', 'like', '%'.$search.'%');
                    });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(20); // Change 10 to the number of items you want per page



        return view('users.index', compact('users'));
    }


    public function create()
    {
        $roleMasters = RoleMaster::all();
        $ukerMasters = UkerMaster::all();
        return view('users.create', compact('ukerMasters','roleMasters'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'role_master_id' => 'required|integer|min:1',
            // 'uker_master_id' => 'required|exists:uker_masters,id',
            // 'has_facility' => 'required|boolean',
            // 'has_reservation' => 'required|boolean',
        ]);

        $data = $request->all();
        $data['password'] = bcrypt($request->password);

        User::create($data);

        return redirect()->route('users.index')
            ->with('success', 'User created successfully.');
    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        $roleMasters = RoleMaster::all();
        $ukerMasters = UkerMaster::all();
        return view('users.edit', compact('user','ukerMasters','roleMasters'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            // 'uker_master_id' => 'required|exists:uker_masters,id',
            // 'has_facility' => 'required|boolean',
            // 'has_reservation' => 'required|boolean',
        ]);

        $data = $request->all();

        // Check if a new password is provided
        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        } else {
            // Remove password field from data to avoid updating it with null
            unset($data['password']);
        }

        $user->update($data);

        return redirect()->route('users.index')
            ->with('success', 'User updated successfully');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')
            ->with('success', 'User deleted successfully');
    }
}