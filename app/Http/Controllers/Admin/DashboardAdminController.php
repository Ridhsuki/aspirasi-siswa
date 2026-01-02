<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Aspiration;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardAdminController extends Controller
{
    public function index()
    {
        $totalStudents = User::where('role', 'user')->count();
        $totalAspirations = Aspiration::count();
        $pendingCount = Aspiration::where('status', 'pending')->count();
        $resolvedCount = Aspiration::where('status', 'resolved')->count();

        $aspirationsPerMonth = Aspiration::select(
            DB::raw('COUNT(id) as count'),
            DB::raw('MONTH(created_at) as month')
        )
        ->whereYear('created_at', date('Y'))
        ->groupBy('month')
        ->orderBy('month')
        ->pluck('count', 'month')
        ->toArray();

        $chartData = [];
        for ($i = 1; $i <= 12; $i++) {
            $chartData[] = $aspirationsPerMonth[$i] ?? 0;
        }

        $latestAspirations = Aspiration::with('user')
            ->latest()
            ->take(3)
            ->get();

        return view('admin.dashboard', compact(
            'totalStudents',
            'totalAspirations',
            'pendingCount',
            'resolvedCount',
            'chartData',
            'latestAspirations'
        ));
    }
}
