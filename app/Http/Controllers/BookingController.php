<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookingRequest;
use App\Http\Requests\UpdateBookingRequest;
use App\Models\Booking;
use App\Models\Court;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        // LOGIC: Initialize stream with relations
        $query = Booking::with(['user', 'court']);

        // LOGIC: Multi-vector Search (ID, Purpose, Client, or Court)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('id', 'like', "%{$search}%")
                  ->orWhere('purpose', 'like', "%{$search}%")
                  ->orWhereHas('user', fn($u) => $u->where('name', 'like', "%{$search}%"))
                  ->orWhereHas('court', fn($c) => $c->where('name', 'like', "%{$search}%"));
            });
        }

        // LOGIC: Status Filter
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // EXECUTE: Get paginated results
        $bookings = $query->latest()->paginate(15)->withQueryString();

        // CONNECT: Siguraduhin na 'bookings.index' ang view file mo
        return view('bookings.index', compact('bookings'));
    }

    public function create()
    {
        $this->authorize('create', Booking::class);
        $courts = Court::where('is_available', true)->orderBy('name')->get();
        return view('bookings.create', compact('courts'));
    }

    public function store(StoreBookingRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = Auth::id();
        $data['status']  = 'pending';

        $court = Court::findOrFail($data['court_id']);
        
        // LOGIC: Precise temporal calculation
        $start = Carbon::parse($data['start_time']);
        $end = Carbon::parse($data['end_time']);
        $hours = max(1, $end->diffInMinutes($start) / 60);
        
        $data['total_price'] = round($hours * (float) $court->hourly_rate, 2);

        if ($request->hasFile('payment_proof')) {
            $data['payment_proof'] = $request->file('payment_proof')->store('payment_proofs', 'public');
        }

        $booking = Booking::create($data);

        return redirect()->route('bookings.show', $booking)
            ->with('success', 'Booking submitted! Awaiting system authorization.');
    }

    public function show(Booking $booking)
    {
        $this->authorize('view', $booking);
        $booking->load('court', 'user');
        return view('bookings.show', compact('booking'));
    }

    public function edit(Booking $booking)
    {
        $this->authorize('update', $booking);
        $courts = Court::where('is_available', true)->orderBy('name')->get();
        return view('bookings.edit', compact('booking', 'courts'));
    }

    public function update(UpdateBookingRequest $request, Booking $booking)
    {
        $data = $request->validated();
        if ($request->hasFile('payment_proof')) {
            $data['payment_proof'] = $request->file('payment_proof')->store('payment_proofs', 'public');
        }
        $booking->update($data);

        return redirect()->route('bookings.show', $booking)
            ->with('success', 'Registry updated.');
    }

    public function cancel(Booking $booking)
    {
        $this->authorize('cancel', $booking);
        $booking->update(['status' => 'cancelled']);
        return back()->with('success', 'Operation cancelled.');
    }

    public function destroy(Booking $booking)
    {
        $this->authorize('delete', $booking);
        $booking->delete();
        return redirect()->route('bookings.index')->with('success', 'Data purged from registry.');
    }
}