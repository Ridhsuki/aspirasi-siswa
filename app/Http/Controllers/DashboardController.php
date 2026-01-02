<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $totalAspirations = $user->aspirations()->count();
        $totalRepliesReceived = $user->aspirations()->withCount('replies')->get()->sum('replies_count');

        $myStats = [
            'total' => $totalAspirations,
            'replies' => $totalRepliesReceived,
        ];

        $recentAspirations = $user->aspirations()->latest()->take(3)->get();

        return view('dashboard', compact('myStats', 'recentAspirations'));
    }
}
