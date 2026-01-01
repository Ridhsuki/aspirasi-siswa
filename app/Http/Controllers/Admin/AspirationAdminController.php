<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Aspiration;
use Illuminate\Http\Request;

class AspirationAdminController extends Controller
{
    public function index(Request $request)
    {
        $query = Aspiration::with(['user', 'replies']);
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('content', 'like', "%{$search}%")
                    ->orWhereHas('user', function ($u) use ($search) {
                        $u->where('name', 'like', "%{$search}%");
                    });
            });
        }

        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        if ($request->filled('type') && $request->type !== 'all') {
            if ($request->type === 'anonymous') {
                $query->where('is_anonymous', true);
            } elseif ($request->type === 'public') {
                $query->where('is_anonymous', false);
            }
        }

        if ($request->filled('date_start')) {
            $query->whereDate('created_at', '>=', $request->date_start);
        }
        if ($request->filled('date_end')) {
            $query->whereDate('created_at', '<=', $request->date_end);
        }

        $sort = $request->input('sort', 'latest');
        if ($sort === 'oldest') {
            $query->oldest();
        } else {
            $query->latest();
        }

        $aspirations = $query->paginate(10)->withQueryString();
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
