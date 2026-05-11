<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingManagementController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('manage', Booking::class);

        $bookings = Booking::with('user', 'court')
            ->when($request->status, fn($q,$s) => $q->status($s))
            ->when($request->search, fn($q,$s) => $q->whereHas('user', fn($u) => $u->where('name', 'like', "%{$s}%")))
            ->latest()->paginate(15)->withQueryString();

        return view('admin.bookings.index', compact('bookings'));
    }

    public function show(Booking $booking)
    {
        $this->authorize('view', $booking);
        return view('admin.bookings.show', compact('booking'));
    }

    public function approve(Booking $booking)
    {
        $this->authorize('manage', Booking::class);
        $booking->update(['status' => 'approved']);
        return back()->with('success', 'Booking approved.');
    }

    public function reject(Request $request, Booking $booking)
    {
        $this->authorize('manage', Booking::class);
        $request->validate(['admin_remark' => ['nullable', 'string', 'max:500']]);
        $booking->update([
            'status' => 'rejected',
            'admin_remark' => $request->admin_remark,
        ]);
        return back()->with('success', 'Booking rejected.');
    }

    public function complete(Booking $booking)
    {
        $this->authorize('manage', Booking::class);
        $booking->update(['status' => 'completed']);
        return back()->with('success', 'Booking marked completed.');
    }

    public function destroy(Booking $booking)
    {
        $this->authorize('delete', $booking);
        $booking->delete();
        return back()->with('success', 'Booking deleted.');
    }
}
