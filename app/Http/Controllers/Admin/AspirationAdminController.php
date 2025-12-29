<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Aspiration;
use Illuminate\Http\Request;

class AspirationAdminController extends Controller
{
    public function index()
    {
        $aspirations = Aspiration::with('user')->latest()->paginate(10);
        return view('admin.aspirations.index', compact('aspirations'));
    }

    public function show($id)
    {
        $aspiration = Aspiration::with(['user', 'replies.user'])->findOrFail($id);
        return view('admin.aspirations.show', compact('aspiration'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,closed,resolved',
        ]);

        $aspiration = Aspiration::findOrFail($id);
        $aspiration->update(['status' => $request->status]);

        return back()->with('success', 'Status aspirasi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $aspiration = Aspiration::findOrFail($id);
        $aspiration->delete();

        return redirect()->route('admin.aspirations.index')->with('success', 'Aspirasi berhasil dihapus.');
    }
}
