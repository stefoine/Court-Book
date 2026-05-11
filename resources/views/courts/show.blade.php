@extends('layouts.app')

@section('title', $court->name)
@section('header', 'Facility Specification')
@section('subheader', 'Technical specifications and availability for ' . $court->name)

@section('content')
<div style="animation: fadeIn 0.8s ease-out; max-width: 48rem; margin: 0 auto;">
    
    {{-- Main Detail Card --}}
    <div style="background: rgba(30, 41, 59, 0.4); backdrop-filter: blur(25px); border: 1px solid rgba(255, 255, 255, 0.05); border-radius: 32px; overflow: hidden; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.6);">
        
        {{-- Image Section --}}
        <div style="padding: 1.5rem;">
            @if($court->image)
                <img src="{{ asset('storage/'.$court->image) }}" style="width: 100%; height: 350px; object-fit: cover; border-radius: 20px; border: 1px solid rgba(255,255,255,0.05);">
            @else
                <div style="width: 100%; height: 250px; border-radius: 20px; background: linear-gradient(135deg, rgba(34, 211, 238, 0.1) 0%, rgba(59, 130, 246, 0.1) 100%); display: flex; align-items: center; justify-content: center; text-shadow: 0 0 20px rgba(34, 211, 238, 0.5); font-size: 5rem; border: 1px solid rgba(255,255,255,0.03);">
                    🏟
                </div>
            @endif
        </div>

        {{-- Info Body --}}
        <div style="padding: 0 2.5rem 2.5rem;">
            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 1.5rem;">
                <div>
                    <h2 style="color: #fff; font-size: 2rem; font-weight: 900; letter-spacing: -0.04em; margin: 0;">{{ $court->name }}</h2>
                    <div style="display: flex; gap: 1rem; margin-top: 0.5rem;">
                        <span style="color: #22d3ee; font-size: 0.8rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em;">{{ $court->type }}</span>
                        <span style="color: #475569; font-size: 0.8rem;">•</span>
                        <span style="color: #cbd5e1; font-size: 0.8rem; font-weight: 600;">{{ $court->capacity }} Person Capacity</span>
                    </div>
                </div>
                <div style="text-align: right;">
                    <div style="font-size: 10px; color: #475569; font-weight: 800; text-transform: uppercase; letter-spacing: 0.1em; margin-bottom: 2px;">Rate per Interval</div>
                    <div style="color: #fff; font-size: 1.5rem; font-weight: 900;">₱{{ number_format($court->hourly_rate,2) }}<small style="font-size: 0.8rem; color: #475569;">/hr</small></div>
                </div>
            </div>

            <div style="background: rgba(255, 255, 255, 0.02); border-radius: 16px; padding: 1.5rem; border: 1px solid rgba(255, 255, 255, 0.05); margin-bottom: 2rem;">
                <label style="display: block; font-size: 10px; color: #475569; font-weight: 800; text-transform: uppercase; letter-spacing: 0.1em; margin-bottom: 8px;">Facility Overview</label>
                <p style="color: #94a3b8; font-size: 1rem; line-height: 1.6; margin: 0;">{{ $court->description }}</p>
            </div>

            {{-- Action Zone --}}
            <div style="display: flex; align-items: center; gap: 1.5rem;">
                @auth
                    <a href="{{ route('bookings.create') }}?court_id={{ $court->id }}" 
                       style="flex: 1; text-align: center; background: linear-gradient(135deg, #22d3ee 0%, #0891b2 100%); color: #0f172a; text-decoration: none; padding: 1.25rem; border-radius: 16px; font-weight: 900; font-size: 0.9rem; text-transform: uppercase; letter-spacing: 0.1em; box-shadow: 0 0 30px rgba(34, 211, 238, 0.3); transition: 0.3s;"
                       onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 0 40px rgba(34, 211, 238, 0.5)';"
                       onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 0 30px rgba(34, 211, 238, 0.3)';">
                        Initialize Booking Protocol
                    </a>
                @else
                    <a href="{{ route('login') }}" 
                       style="flex: 1; text-align: center; background: rgba(255,255,255,0.05); color: #fff; text-decoration: none; padding: 1.25rem; border-radius: 16px; font-weight: 900; font-size: 0.9rem; text-transform: uppercase; letter-spacing: 0.1em; border: 1px solid rgba(255,255,255,0.1); transition: 0.3s;"
                       onmouseover="this.style.background='rgba(255,255,255,0.1)';">
                        Sign In to Authorize Booking
                    </a>
                @endauth
                
                <a href="{{ route('courts.index') }}" style="color: #475569; text-decoration: none; font-size: 0.8rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; transition: 0.2s;" onmouseover="this.style.color='#fff'">
                    Back
                </a>
            </div>
        </div>
    </div>

    {{-- Meta Data --}}
    <div style="margin-top: 1.5rem; display: flex; justify-content: center; gap: 2rem;">
        <div style="display: flex; align-items: center; gap: 8px;">
            <div style="width: 8px; height: 8px; border-radius: 50%; background: #10b981; box-shadow: 0 0 10px #10b981;"></div>
            <span style="font-size: 10px; color: #1e293b; font-weight: 800; text-transform: uppercase;">System Online</span>
        </div>
        <div style="display: flex; align-items: center; gap: 8px;">
            <div style="width: 8px; height: 8px; border-radius: 50%; background: #22d3ee; box-shadow: 0 0 10px #22d3ee;"></div>
            <span style="font-size: 10px; color: #1e293b; font-weight: 800; text-transform: uppercase;">Encryption Active</span>
        </div>
    </div>
</div>

<style>
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endsection