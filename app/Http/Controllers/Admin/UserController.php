<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('role', 'user')->latest()->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'nisn' => ['required', 'string', 'max:20', 'unique:' . User::class],
            'kelas' => ['required', 'string', 'max:50'],
            'walikelas' => ['nullable', 'string', 'max:255'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'nisn' => $request->nisn,
            'kelas' => $request->kelas,
            'walikelas' => $request->walikelas,
            'password' => Hash::make($request->password),
            'role' => 'user',
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Data siswa berhasil ditambahkan.');
    }

    public function show(User $user)
    {
        $user->load([
            'aspirations' => function ($query) {
                $query->latest();
            },
            'replies.aspiration' => function ($query) {
                $query->latest();
            }
        ]);

        $stats = [
            'latest_activity' => $user->aspirations->first()?->created_at ?? $user->replies->first()?->created_at ?? $user->created_at,
        ];

        return view('admin.users.show', compact('user', 'stats'));
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'nisn' => ['required', 'string', 'max:20', 'unique:users,nisn,' . $user->id],
            'kelas' => ['required', 'string', 'max:50'],
            'walikelas' => ['nullable', 'string', 'max:255'],
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'nisn' => $request->nisn,
            'kelas' => $request->kelas,
            'walikelas' => $request->walikelas,
        ];

        if ($request->filled('password')) {
            $request->validate([
                'password' => ['confirmed', Rules\Password::defaults()],
            ]);
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.users.index')->with('success', 'Data siswa berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        if ($user->role === 'admin') {
            return back()->with('error', 'Admin tidak dapat dihapus.');
        }

        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'Siswa berhasil dihapus.');
    }
}
