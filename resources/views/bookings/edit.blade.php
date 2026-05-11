@extends('layouts.app')

@section('title', 'Reconfigure Operation #' . $booking->id)
@section('header', 'System Reconfiguration')
@section('subheader', 'Modifying existing reservation parameters in the global registry')

@section('content')
<div style="animation: fadeIn 0.8s cubic-bezier(0.4, 0, 0.2, 1); max-width: 800px; margin: 0 auto;">

    {{-- System Status Indicator (Decorative Logic) --}}
    <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 2rem; padding: 0 1rem;">
        <div style="display: flex; gap: 5px;">
            <div style="width: 12px; height: 12px; border-radius: 2px; background: #22d3ee; box-shadow: 0 0 10px #22d3ee;"></div>
            <div style="width: 12px; height: 12px; border-radius: 2px; background: rgba(34, 211, 238, 0.2);"></div>
            <div style="width: 12px; height: 12px; border-radius: 2px; background: rgba(34, 211, 238, 0.2);"></div>
        </div>
        <div style="font-family: 'JetBrains Mono', monospace; font-size: 10px; color: #475569; text-transform: uppercase; letter-spacing: 0.2em;">
            Mode: Configuration_Update // ID: {{ $booking->id }}
        </div>
    </div>

    {{-- Modification Matrix (The Card) --}}
    <div style="background: rgba(15, 23, 42, 0.4); backdrop-filter: blur(25px); border: 1px solid rgba(255, 255, 255, 0.05); border-radius: 32px; overflow: hidden; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);">
        
        {{-- Internal Header --}}
        <div style="background: rgba(255, 255, 255, 0.02); padding: 1.5rem 2rem; border-bottom: 1px solid rgba(255, 255, 255, 0.05);">
            <h3 style="color: #fff; font-size: 1.1rem; font-weight: 800; margin: 0; display: flex; align-items: center; gap: 12px;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#22d3ee" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                Parameter Adjustment
            </h3>
        </div>

        {{-- Form Logic --}}
        <form method="POST" action="{{ route('bookings.update', $booking) }}" enctype="multipart/form-data" style="padding: 2rem;">
            @csrf 
            @method('PUT')

            {{-- Logic Gate: Form Fields --}}
            <div style="margin-bottom: 2rem;">
                @include('bookings._form', ['booking' => $booking])
            </div>

            {{-- Action Connectives --}}
            <div style="display: flex; flex-direction: column; gap: 15px; border-top: 1px solid rgba(255, 255, 255, 0.05); padding-top: 2rem;">
                <button type="submit" 
                        style="width: 100%; background: linear-gradient(135deg, #22d3ee 0%, #0891b2 100%); color: #0f172a; border: none; padding: 1rem; border-radius: 16px; font-weight: 900; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.15em; cursor: pointer; transition: 0.3s; box-shadow: 0 0 20px rgba(34, 211, 238, 0.2);"
                        onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 5px 25px rgba(34, 211, 238, 0.4)';"
                        onmouseout="this.style.transform='translateY(0)';"
                >
                    Commit Changes
                </button>

                <a href="{{ route('bookings.show', $booking) }}" 
                   style="width: 100%; text-align: center; color: #475569; text-decoration: none; font-size: 0.75rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.1em; transition: 0.2s;"
                   onmouseover="this.style.color='#cbd5e1'"
                >
                    Abort & Return to Dossier
                </a>
            </div>
        </form>
    </div>

    {{-- Metadata Footer --}}
    <div style="margin-top: 1.5rem; text-align: center; opacity: 0.4;">
        <p style="font-family: 'JetBrains Mono', monospace; font-size: 9px; color: #64748b; text-transform: uppercase;">
            Data_Integrity: Verified // Encrypted_Stream: Active
        </p>
    </div>
</div>

<style>
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    /* Logic: Styling the injected _form fields to match the futuristic design */
    input, select, textarea {
        background: rgba(0, 0, 0, 0.3) !important;
        border: 1px solid rgba(255, 255, 255, 0.1) !important;
        border-radius: 12px !important;
        color: #fff !important;
        padding: 0.75rem 1rem !important;
    }
    
    input:focus, select:focus, textarea:focus {
        border-color: #22d3ee !important;
        box-shadow: 0 0 10px rgba(34, 211, 238, 0.2) !important;
        outline: none !important;
    }

    label {
        color: #475569 !important;
        font-size: 0.75rem !important;
        text-transform: uppercase !important;
        letter-spacing: 0.1em !important;
        font-weight: 800 !important;
        margin-bottom: 0.5rem !important;
        display: block !important;
    }
</style>
@endsection