<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Aspiration;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $students = User::where('role', 'user')->latest()->get();

        $aspirations = Aspiration::with(['user', 'replies'])
            ->latest()
            ->get();

        return view('admin.dashboard', compact('students', 'aspirations'));
    }

    public function updateStatus(Request $request, $id)
    {
        $aspirasi = Aspiration::findOrFail($id);

        $request->validate([
            'status' => 'required|in:pending,approved,rejected'
        ]);

        $aspirasi->update(['status' => $request->status]);

        return back()->with('success', 'Status aspirasi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if ($user->role !== 'admin') {
            $user->delete();
            return back()->with('success', 'User berhasil dihapus.');
        }
        return back()->with('error', 'Tidak bisa menghapus Admin.');
    }
}
