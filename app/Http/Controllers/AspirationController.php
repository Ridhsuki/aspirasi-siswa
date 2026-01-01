<?php

namespace App\Http\Controllers;

use App\Models\Aspiration;
use App\Models\Reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AspirationController extends Controller
{
    public function index(Request $request)
    {
        $aspirations = Aspiration::with(['user', 'replies.user'])
            ->latest()
            ->paginate(10);

        if ($request->ajax()) {
            return view('aspirations.partials.list', compact('aspirations'))->render();
        }

        return view('aspirations.index', compact('aspirations'));
    }

    public function show($id)
    {
        $aspiration = Aspiration::with(['user', 'replies.user'])
            ->findOrFail($id);

        return view('aspirations.show', compact('aspiration'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string|max:500',
        ]);

        Aspiration::create([
            'user_id' => Auth::id(),
            'content' => $request->input('content'),
            'status' => 'pending',
            'is_anonymous' => $request->has('is_anonymous'),
        ]);

        return back()->with('success', 'Aspirasi berhasil dikirim!');
    }

    public function storeReply(Request $request, $aspiration_id)
    {
        $request->validate([
            'content' => 'required|string|max:500',
        ]);

        Reply::create([
            'user_id' => Auth::id(),
            'aspiration_id' => $aspiration_id,
            'content' => $request->input('content'),
            'is_anonymous' => $request->has('is_anonymous'),
        ]);

        return back()->with('success', 'Balasan berhasil dikirim!');
    }

    public function destroy($id)
    {
        $aspiration = Aspiration::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $aspiration->delete();

        return redirect()->route('aspirations.index')->with('success', 'Aspirasi berhasil dihapus.');
    }

    public function destroyReply($id)
    {
        $reply = Reply::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $reply->delete();

        return back()->with('success', 'Balasan berhasil dihapus.');
    }

    public function activity(Request $request)
    {
        $user = Auth::user();

        if ($request->ajax() && $request->has('asp_page')) {
            $aspirations = $user->aspirations()->latest()->paginate(5, ['*'], 'asp_page');
            return view('admin.aspirations.partials.activity_aspirations', compact('aspirations'))->render();
        }

        if ($request->ajax() && $request->has('reply_page')) {
            $replies = $user->replies()->with('aspiration')->latest()->paginate(5, ['*'], 'reply_page');
            return view('admin.aspirations.partials.activity_replies', compact('replies'))->render();
        }

        $aspirations = $user->aspirations()->latest()->paginate(5, ['*'], 'asp_page');
        $replies = $user->replies()->with('aspiration')->latest()->paginate(5, ['*'], 'reply_page');

        return view('admin.aspirations.activity', compact('aspirations', 'replies'));
    }
}
