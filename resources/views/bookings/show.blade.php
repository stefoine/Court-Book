@extends('layouts.app')

@section('title', 'Operation Dossier #' . $booking->id)
@section('header', 'Data Analysis')
@section('subheader', 'Detailed breakdown of reservation parameters')

@section('content')
<div style="animation: fadeIn 0.8s cubic-bezier(0.4, 0, 0.2, 1);" class="grid lg:grid-cols-3 gap-6">
    
    {{-- Main Data Core --}}
    <div style="background: rgba(15, 23, 42, 0.4); backdrop-filter: blur(20px); border: 1px solid rgba(255, 255, 255, 0.05); border-radius: 28px; padding: 2rem;" class="lg:col-span-2 space-y-6">
        
        {{-- Header Sector --}}
        <div style="border-bottom: 1px solid rgba(255, 255, 255, 0.05); padding-bottom: 1.5rem; display: flex; justify-content: space-between; align-items: flex-start;">
            <div>
                <h3 style="color: #fff; font-size: 1.5rem; font-weight: 800; letter-spacing: -0.02em; margin-bottom: 5px;">
                    {{ $booking->court->name }}
                </h3>
                <div style="display: flex; align-items: center; gap: 10px;">
                    <span style="font-family: 'JetBrains Mono', monospace; font-size: 10px; color: #22d3ee; text-transform: uppercase; letter-spacing: 0.1em; background: rgba(34, 211, 238, 0.1); padding: 2px 8px; border-radius: 4px;">
                        Sector: {{ $booking->sport_type }}
                    </span>
                    <span style="color: #475569; font-size: 0.85rem;">{{ $booking->purpose }}</span>
                </div>
            </div>
            <div style="text-align: right;">
                <div style="font-size: 10px; color: #475569; text-transform: uppercase; letter-spacing: 0.1em; margin-bottom: 4px;">Operation ID</div>
                <div style="font-family: 'JetBrains Mono', monospace; color: #fff; font-weight: 900;">#{{ str_pad($booking->id, 6, '0', STR_PAD_LEFT) }}</div>
            </div>
        </div>

        {{-- Parameter Grid --}}
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.5rem;">
            <div style="background: rgba(255, 255, 255, 0.02); padding: 1.25rem; border-radius: 16px; border: 1px solid rgba(255, 255, 255, 0.03);">
                <div style="font-size: 10px; color: #475569; text-transform: uppercase; margin-bottom: 8px;">Temporal window</div>
                <div style="color: #cbd5e1; font-weight: 700; font-size: 0.9rem;">{{ $booking->booking_date->format('F d, Y') }}</div>
                <div style="font-family: 'JetBrains Mono', monospace; color: #22d3ee; font-size: 0.8rem; margin-top: 4px;">
                    {{ \Illuminate\Support\Carbon::parse($booking->start_time)->format('H:i') }} – {{ \Illuminate\Support\Carbon::parse($booking->end_time)->format('H:i') }}
                </div>
            </div>

            <div style="background: rgba(255, 255, 255, 0.02); padding: 1.25rem; border-radius: 16px; border: 1px solid rgba(255, 255, 255, 0.03);">
                <div style="font-size: 10px; color: #475569; text-transform: uppercase; margin-bottom: 8px;">Financial Logic</div>
                <div style="color: #fff; font-weight: 900; font-size: 1.1rem;">₱{{ number_format($booking->total_price,2) }}</div>
                <div style="font-size: 10px; color: #10b981; margin-top: 4px;">Credits Verified</div>
            </div>

            <div style="background: rgba(255, 255, 255, 0.02); padding: 1.25rem; border-radius: 16px; border: 1px solid rgba(255, 255, 255, 0.03);">
                <div style="font-size: 10px; color: #475569; text-transform: uppercase; margin-bottom: 8px;">Protocol Status</div>
                <span style="display: inline-block; padding: 4px 12px; border-radius: 8px; font-size: 10px; font-weight: 900; text-transform: uppercase; border: 1px solid currentColor;
                    @if($booking->status === 'approved') color: #10b981; @elseif($booking->status === 'pending') color: #f59e0b; @else color: #f43f5e; @endif">
                    {{ $booking->status }}
                </span>
            </div>
        </div>

        {{-- Notes & Logic Segments --}}
        @if($booking->notes)
            <div style="padding-top: 1rem;">
                <label style="font-size: 10px; color: #475569; text-transform: uppercase; letter-spacing: 0.1em; display: block; margin-bottom: 10px;">User Notes</label>
                <div style="color: #94a3b8; font-size: 0.9rem; line-height: 1.6; background: rgba(0,0,0,0.2); padding: 1rem; border-radius: 12px;">
                    {{ $booking->notes }}
                </div>
            </div>
        @endif

        @if($booking->admin_remark)
            <div style="background: rgba(245, 158, 11, 0.05); border: 1px solid rgba(245, 158, 11, 0.2); padding: 1.25rem; border-radius: 16px;">
                <div style="font-size: 10px; color: #f59e0b; text-transform: uppercase; font-weight: 900; margin-bottom: 8px;">System Override / Remark</div>
                <p style="color: #cbd5e1; font-size: 0.9rem; margin: 0;">{{ $booking->admin_remark }}</p>
            </div>
        @endif

        @if($booking->payment_proof)
            <div style="border-top: 1px solid rgba(255, 255, 255, 0.05); padding-top: 1.5rem;">
                <label style="font-size: 10px; color: #475569; text-transform: uppercase; letter-spacing: 0.1em; display: block; margin-bottom: 15px;">Attachment: Payment_Proof.img</label>
                <div style="position: relative; display: inline-block; border-radius: 20px; overflow: hidden; border: 1px solid rgba(255,255,255,0.1);">
                    <img src="{{ asset('storage/'.$booking->payment_proof) }}" style="max-width: 100%; max-height: 300px; display: block;">
                    <div style="position: absolute; inset: 0; box-shadow: inset 0 0 40px rgba(0,0,0,0.4);"></div>
                </div>
            </div>
        @endif
    </div>

    {{-- Action Terminal --}}
    <div style="display: flex; flex-direction: column; gap: 1.5rem;">
        <div style="background: rgba(30, 41, 59, 0.4); backdrop-filter: blur(20px); border: 1px solid rgba(255, 255, 255, 0.05); border-radius: 24px; padding: 1.5rem; position: sticky; top: 2rem;">
            <h4 style="color: #fff; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.15em; font-weight: 900; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 10px;">
                <span style="width: 8px; height: 8px; border-radius: 50%; background: #22d3ee; box-shadow: 0 0 10px #22d3ee;"></span>
                Command Terminal
            </h4>
            
            <div style="display: flex; flex-direction: column; gap: 10px;">
                @can('update', $booking)
                    <a href="{{ route('bookings.edit', $booking) }}" 
                       style="background: rgba(255,255,255,0.05); color: #fff; text-decoration: none; padding: 0.8rem; border-radius: 12px; text-align: center; font-size: 0.8rem; font-weight: 700; text-transform: uppercase; border: 1px solid rgba(255,255,255,0.1); transition: 0.3s;"
                       onmouseover="this.style.background='rgba(255,255,255,0.1)'; this.style.transform='translateY(-2px)';"
                       onmouseout="this.style.background='rgba(255,255,255,0.05)'; this.style.transform='translateY(0)';">
                        Modify Registry
                    </a>
                @endcan

                @can('cancel', $booking)
                    <form method="POST" action="{{ route('bookings.cancel', $booking) }}">
                        @csrf 
                        <button style="width: 100%; background: rgba(244, 63, 94, 0.1); color: #f43f5e; border: 1px solid rgba(244, 63, 94, 0.2); padding: 0.8rem; border-radius: 12px; font-weight: 700; text-transform: uppercase; font-size: 0.8rem; cursor: pointer; transition: 0.3s;"
                                onmouseover="this.style.background='rgba(244, 63, 94, 0.2)';"
                                onclick="return confirm('Abort operation?')">
                            Abort Operation
                        </button>
                    </form>
                @endcan

                <a href="{{ route('bookings.index') }}" 
                   style="color: #475569; text-decoration: none; padding: 0.8rem; text-align: center; font-size: 0.75rem; font-weight: 800; text-transform: uppercase; transition: 0.2s;"
                   onmouseover="this.style.color='#cbd5e1'">
                    Return to Registry
                </a>
            </div>
        </div>
        
        {{-- System Health Indicator (Decorative) --}}
        <div style="padding: 1.5rem; background: rgba(15, 23, 42, 0.2); border-radius: 24px; border: 1px dashed rgba(255,255,255,0.05);">
            <div style="font-size: 9px; color: #475569; text-transform: uppercase; margin-bottom: 10px; font-family: 'JetBrains Mono', monospace;">System_Status: Optimal</div>
            <div style="display: flex; gap: 4px;">
                @for($i=0; $i<12; $i++)
                    <div style="height: 3px; flex: 1; background: #10b981; border-radius: 2px; opacity: {{ 0.2 + ($i * 0.06) }};"></div>
                @endfor
            </div>
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