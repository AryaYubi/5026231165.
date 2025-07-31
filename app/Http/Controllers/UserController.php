<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'name'          => ['required', 'string', 'max:255'],
        'username'      => ['required', 'string', 'max:255', 'unique:users'],
        'password'      => ['required', 'confirmed', Rules\Password::defaults()],
        'jabatan'       => ['required', 'string', 'max:255'],
        'kode_kantor'   => ['required', 'string', 'max:255'],
        'role'          => ['required', 'string'],
        'status'        => ['required', 'string'],
    ]);

    User::create([
        'name'          => $request->name,
        'username'      => $request->username,
        'password'      => Hash::make($request->password),
        'jabatan'       => $request->jabatan,
        'kode_kantor'   => $request->kode_kantor,
        'role'          => $request->role,
        'status'        => $request->status,
    ]);

    return redirect()->route('admin.users.index')->with('success', 'Pengguna baru berhasil ditambahkan.');
}

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        'username' => 'required|string|max:255|unique:users,username,'.$user->id,
        'role' => 'required',
        'status' => 'required',
        'password' => 'nullable|confirmed|min:8', // 'confirmed' akan otomatis cek 'password_confirmation'
        ]);

        $userData = $request->only(['name', 'username', 'jabatan', 'kode_kantor', 'role', 'status']);

        // Hanya update password jika diisi
        if ($request->filled('password')) {
            $request->validate(['password' => ['required', 'confirmed', Rules\Password::defaults()]]);
            $userData['password'] = Hash::make($request->password);
        }

        $user->update($userData);

        return redirect()->route('admin.users.index')->with('success', 'Data pengguna berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'Pengguna berhasil dihapus.');
    }
}
