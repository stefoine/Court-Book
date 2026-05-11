<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $stats = [
            'total'    => Booking::where('user_id', $user->id)->count(),
            'approved' => Booking::where('user_id', $user->id)->status('approved')->count(),
            'pending'  => Booking::where('user_id', $user->id)->status('pending')->count(),
            'completed'=> Booking::where('user_id', $user->id)->status('completed')->count(),
        ];

        $upcoming = Booking::with('court')
            ->where('user_id', $user->id)
            ->whereIn('status', ['approved', 'pending'])
            ->where('booking_date', '>=', now()->toDateString())
            ->orderBy('booking_date')->orderBy('start_time')
            ->take(5)->get();

        return view('user.dashboard', compact('stats', 'upcoming'));
    }
}
