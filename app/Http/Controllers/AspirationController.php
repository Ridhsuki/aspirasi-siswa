<?php

namespace App\Http\Controllers;

use App\Models\Aspiration;
use App\Models\Reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AspirationController extends Controller
{
    public function index()
    {
        $aspirations = Aspiration::with(['user', 'replies.user'])
            ->latest()
            ->get();

        return view('dashboard', compact('aspirations'));
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
        ]);

        return back()->with('success', 'Balasan berhasil dikirim!');
    }

    public function destroy($id)
    {
        $aspiration = Aspiration::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $aspiration->delete();

        return back()->with('success', 'Aspirasi berhasil dihapus.');
    }

    public function destroyReply($id)
    {
        $reply = Reply::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $reply->delete();

        return back()->with('success', 'Balasan berhasil dihapus.');
    }
}
