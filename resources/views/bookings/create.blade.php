@extends('layouts.app')

@section('title', 'New Booking Protocol')
@section('header', 'Booking Initialization')
@section('subheader', 'Configure temporal parameters and operational details')

@section('content')
<div style="animation: fadeIn 0.8s ease-out; max-width: 42rem; margin: 0 auto;">
    
    {{-- Deployment Terminal Card --}}
    <div style="background: rgba(30, 41, 59, 0.4); backdrop-filter: blur(25px); border: 1px solid rgba(255, 255, 255, 0.05); border-radius: 24px; padding: 2.5rem; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.6); position: relative; overflow: hidden;">
        
        {{-- Protocol Header --}}
        <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 2rem; padding-bottom: 1.5rem; border-bottom: 1px solid rgba(255, 255, 255, 0.05);">
            <div style="width: 10px; height: 10px; border-radius: 50%; background: #22d3ee; box-shadow: 0 0 15px rgba(34, 211, 238, 0.6);"></div>
            <h3 style="color: #fff; font-weight: 800; font-size: 1rem; margin: 0; text-transform: uppercase; letter-spacing: 0.1em;">Reservation Protocol</h3>
        </div>

        <form method="POST" action="{{ route('bookings.store') }}" enctype="multipart/form-data" style="display: flex; flex-direction: column; gap: 1.5rem;">
            @csrf

            {{-- Dito papasok yung futuristic form fields --}}
            <div style="color: #cbd5e1;">
                @include('bookings._form', ['booking' => null])
            </div>

            {{-- Submit Action --}}
            <div style="margin-top: 1rem; display: flex; flex-direction: column; gap: 1rem;">
                <button type="submit" 
                        style="background: linear-gradient(135deg, #22d3ee 0%, #0891b2 100%); color: #0f172a; border: none; padding: 1.25rem; border-radius: 16px; font-weight: 900; font-size: 0.9rem; text-transform: uppercase; letter-spacing: 0.15em; cursor: pointer; transition: 0.3s; box-shadow: 0 4px 15px rgba(34, 211, 238, 0.2);"
                        onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 25px rgba(34, 211, 238, 0.4)';"
                        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 15px rgba(34, 211, 238, 0.2)';"
                        onclick="this.innerText='COMMITTING TO DATABASE...'">
                    Authorize & Submit Booking
                </button>

                <a href="{{ url()->previous() }}" 
                   style="text-align: center; color: #475569; text-decoration: none; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.1em; transition: 0.2s;"
                   onmouseover="this.style.color='#94a3b8';"
                   onmouseout="this.style.color='#475569';">
                    Abort Protocol
                </a>
            </div>
        </form>
    </div>

    {{-- System Status Footer --}}
    <div style="margin-top: 2rem; display: flex; justify-content: center; gap: 1.5rem;">
        <div style="display: flex; align-items: center; gap: 8px;">
            <div style="width: 6px; height: 6px; border-radius: 50%; background: #10b981;"></div>
            <span style="font-family: 'JetBrains Mono', monospace; font-size: 9px; color: #334155; text-transform: uppercase;">Temporal Sync: Active</span>
        </div>
        <div style="display: flex; align-items: center; gap: 8px;">
            <div style="width: 6px; height: 6px; border-radius: 50%; background: #22d3ee;"></div>
            <span style="font-family: 'JetBrains Mono', monospace; font-size: 9px; color: #334155; text-transform: uppercase;">Encryption: AES-256</span>
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