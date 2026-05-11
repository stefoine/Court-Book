@extends('layouts.app')

@section('title', 'Booking Terminal #' . $booking->id)
@section('header', 'Booking Manifest')
@section('subheader', 'Transaction ID: #BK-' . $booking->id)

@section('content')
<div style="animation: fadeIn 0.8s ease-out; max-width: 48rem; margin: 0 auto;">
    
    {{-- Main Detail Card --}}
    <div style="background: rgba(30, 41, 59, 0.4); backdrop-filter: blur(20px); border: 1px solid rgba(255, 255, 255, 0.05); border-radius: 24px; overflow: hidden; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);">
        
        {{-- Header Status Bar --}}
        <div style="padding: 1.5rem 2rem; background: rgba(255, 255, 255, 0.02); border-bottom: 1px solid rgba(255, 255, 255, 0.05); display: flex; justify-content: space-between; align-items: center;">
            <div style="display: flex; align-items: center; gap: 12px;">
                <div style="width: 10px; height: 10px; border-radius: 50%; background: #22d3ee; box-shadow: 0 0 10px #22d3ee;"></div>
                <h3 style="color: #fff; font-weight: 800; font-size: 1.25rem; margin: 0; letter-spacing: -0.025em;">{{ $booking->court->name }}</h3>
            </div>
            <span style="padding: 6px 16px; border-radius: 20px; font-size: 0.7rem; font-weight: 900; text-transform: uppercase; letter-spacing: 0.1em; border: 1px solid currentColor;
                @if($booking->status === 'approved') color: #10b981; background: rgba(16, 185, 129, 0.1); 
                @elseif($booking->status === 'pending') color: #f59e0b; background: rgba(245, 158, 11, 0.1);
                @else color: #94a3b8; background: rgba(148, 163, 184, 0.1); @endif">
                {{ $booking->status }}
            </span>
        </div>

        <div style="padding: 2rem; display: grid; grid-template-columns: 1fr 1fr; gap: 2rem;">
            
            {{-- Left Column: Info --}}
            <div style="display: flex; flex-direction: column; gap: 1.5rem;">
                <div>
                    <label style="display: block; font-size: 10px; color: #475569; text-transform: uppercase; font-weight: 800; letter-spacing: 0.1em; margin-bottom: 4px;">Requesting Entity</label>
                    <div style="color: #fff; font-weight: 700;">{{ $booking->user->name }}</div>
                    <div style="color: #94a3b8; font-size: 0.8rem;">{{ $booking->user->email }}</div>
                </div>

                <div>
                    <label style="display: block; font-size: 10px; color: #475569; text-transform: uppercase; font-weight: 800; letter-spacing: 0.1em; margin-bottom: 4px;">Temporal Schedule</label>
                    <div style="color: #fff; font-weight: 700;">{{ $booking->booking_date->format('F d, Y') }}</div>
                    <div style="color: #22d3ee; font-family: 'JetBrains Mono', monospace; font-size: 0.9rem;">
                        {{ \Illuminate\Support\Carbon::parse($booking->start_time)->format('H:i') }} — {{ \Illuminate\Support\Carbon::parse($booking->end_time)->format('H:i') }}
                    </div>
                </div>

                <div>
                    <label style="display: block; font-size: 10px; color: #475569; text-transform: uppercase; font-weight: 800; letter-spacing: 0.1em; margin-bottom: 4px;">Classification</label>
                    <div style="color: #cbd5e1; font-size: 0.9rem;">{{ $booking->sport_type }} <span style="color: #475569; margin: 0 8px;">//</span> {{ $booking->purpose }}</div>
                </div>
            </div>

            {{-- Right Column: Financial & Notes --}}
            <div style="display: flex; flex-direction: column; gap: 1.5rem;">
                <div style="background: rgba(0,0,0,0.2); padding: 1.25rem; border-radius: 16px; border: 1px solid rgba(255,255,255,0.03);">
                    <label style="display: block; font-size: 10px; color: #475569; text-transform: uppercase; font-weight: 800; letter-spacing: 0.1em; margin-bottom: 8px;">Settlement Amount</label>
                    <div style="color: #fff; font-size: 1.75rem; font-weight: 900; letter-spacing: -0.05em;">₱{{ number_format($booking->total_price, 2) }}</div>
                </div>

                @if($booking->notes)
                <div>
                    <label style="display: block; font-size: 10px; color: #475569; text-transform: uppercase; font-weight: 800; letter-spacing: 0.1em; margin-bottom: 4px;">System Notes</label>
                    <div style="color: #94a3b8; font-size: 0.85rem; font-style: italic; background: rgba(255,255,255,0.02); padding: 0.75rem; border-radius: 8px;">"{{ $booking->notes }}"</div>
                </div>
                @endif
            </div>
        </div>

        {{-- Payment Proof Section --}}
        @if($booking->payment_proof)
        <div style="padding: 0 2rem 2rem;">
            <label style="display: block; font-size: 10px; color: #475569; text-transform: uppercase; font-weight: 800; letter-spacing: 0.1em; margin-bottom: 12px;">Validation Image (Payment Proof)</label>
            <div style="position: relative; width: fit-content; group">
                <img src="{{ asset('storage/'.$booking->payment_proof) }}" style="max-width: 100%; max-height: 300px; border-radius: 12px; border: 1px solid rgba(255,255,255,0.1); box-shadow: 0 10px 30px rgba(0,0,0,0.3);">
            </div>
        </div>
        @endif

        {{-- Action Terminal --}}
        <div style="padding: 1.5rem 2rem; background: rgba(0,0,0,0.2); border-top: 1px solid rgba(255, 255, 255, 0.05); display: flex; flex-wrap: wrap; gap: 1rem; align-items: center;">
            @if($booking->status === 'pending')
                <form method="POST" action="{{ route('admin.bookings.approve',$booking) }}">
                    @csrf
                    <button style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: #fff; border: none; padding: 0.75rem 1.5rem; border-radius: 10px; font-weight: 700; font-size: 0.8rem; text-transform: uppercase; cursor: pointer; transition: 0.3s; box-shadow: 0 4px 15px rgba(16, 185, 129, 0.2);" onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform='translateY(0)'">
                        Authorize Access
                    </button>
                </form>

                <form method="POST" action="{{ route('admin.bookings.reject',$booking) }}" style="display: flex; gap: 0.5rem; flex: 1;">
                    @csrf
                    <input class="input" name="admin_remark" placeholder="Reason for rejection..." style="flex: 1; background: rgba(15, 23, 42, 0.5); border: 1px solid rgba(255,255,255,0.1); border-radius: 10px; padding: 0.75rem; color: #fff; font-size: 0.85rem; outline: none;">
                    <button style="background: rgba(244, 63, 94, 0.1); color: #f43f5e; border: 1px solid rgba(244, 63, 94, 0.2); padding: 0.75rem 1.25rem; border-radius: 10px; font-weight: 700; font-size: 0.8rem; text-transform: uppercase; cursor: pointer; transition: 0.3s;" onmouseover="this.style.background='rgba(244, 63, 94, 0.2)'" onmouseout="this.style.background='rgba(244, 63, 94, 0.1)'">
                        Decline
                    </button>
                </form>
            @endif

            @if($booking->status === 'approved')
                <form method="POST" action="{{ route('admin.bookings.complete',$booking) }}">
                    @csrf
                    <button style="background: rgba(34, 211, 238, 0.1); color: #22d3ee; border: 1px solid rgba(34, 211, 238, 0.2); padding: 0.75rem 1.5rem; border-radius: 10px; font-weight: 700; font-size: 0.8rem; text-transform: uppercase; cursor: pointer;" onmouseover="this.style.background='rgba(34, 211, 238, 0.2)'" onmouseout="this.style.background='rgba(34, 211, 238, 0.1)'">
                        Mark as Fulfilled
                    </button>
                </form>
            @endif

            <a href="{{ route('admin.bookings.index') }}" style="margin-left: auto; color: #475569; text-decoration: none; font-size: 0.8rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.1em; transition: 0.3s;" onmouseover="this.style.color='#fff'" onmouseout="this.style.color='#475569'">
                ← Return to Registry
            </a>
        </div>
    </div>
</div>

<style>
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .input::placeholder { color: #334155; }
</style>
@endsection