<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Court;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class AdminController extends Controller
{
    public function dashboard()
    {
        Gate::authorize('access-admin-dashboard');

        $stats = [
            'users'           => User::count(),
            'bookings'        => Booking::count(),
            'active_bookings' => Booking::whereIn('status', ['pending','approved'])->count(),
            'courts'          => Court::count(),
            'monthly'         => Booking::whereMonth('created_at', now()->month)->count(),
        ];

        $mostBookedSport = Booking::select('sport_type', DB::raw('COUNT(*) as total'))
            ->groupBy('sport_type')->orderByDesc('total')->first();

        $recent = Booking::with('user', 'court')->latest()->take(8)->get();

        $byStatus = Booking::select('status', DB::raw('COUNT(*) as total'))
            ->groupBy('status')->pluck('total', 'status');

        return view('admin.dashboard', compact('stats', 'mostBookedSport', 'recent', 'byStatus'));
    }

    public function reports()
    {
        Gate::authorize('manage-reports');

        $monthly = Booking::select(
                DB::raw("DATE_FORMAT(created_at, '%Y-%m') as month"),
                DB::raw('COUNT(*) as total')
            )->groupBy('month')->orderBy('month','desc')->take(12)->get();

        $perCourt = Booking::with('court')
            ->select('court_id', DB::raw('COUNT(*) as total'))
            ->groupBy('court_id')->orderByDesc('total')->get();

        return view('admin.reports', compact('monthly', 'perCourt'));
    }
}
