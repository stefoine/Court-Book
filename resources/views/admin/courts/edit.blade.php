@extends('layouts.app')

@section('title', 'Initialize New Arena')
@section('header', 'Arena Deployment')
@section('subheader', 'Registering New Facility to System Core')

@section('content')
<div style="animation: fadeIn 0.8s ease-out; max-width: 42rem; margin: 0 auto;">
    
    {{-- Main Deployment Terminal --}}
    <div style="background: rgba(30, 41, 59, 0.4); backdrop-filter: blur(20px); border: 1px solid rgba(255, 255, 255, 0.05); border-radius: 24px; padding: 2rem; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);">
        
        {{-- Protocol Header --}}
        <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 2rem; padding-bottom: 1.5rem; border-bottom: 1px solid rgba(255, 255, 255, 0.05);">
            <div style="width: 12px; height: 12px; border-radius: 50%; background: #22d3ee; box-shadow: 0 0 15px rgba(34, 211, 238, 0.6);"></div>
            <h3 style="color: #fff; font-weight: 800; font-size: 1.1rem; margin: 0; text-transform: uppercase; letter-spacing: 0.05em;">New Entry Protocol</h3>
        </div>

        <form method="POST" action="{{ route('admin.courts.store') }}" enctype="multipart/form-data" style="display: flex; flex-direction: column; gap: 2rem;">
            @csrf 

            {{-- Futuristic Form Fields --}}
            @include('admin.courts._form', ['court' => null])

            {{-- Action Terminal --}}
            <div style="display: flex; flex-direction: column; gap: 1rem; margin-top: 1rem;">
                <button type="submit" 
                        style="background: linear-gradient(135deg, #22d3ee 0%, #0891b2 100%); color: #0f172a; border: none; padding: 1rem; border-radius: 12px; font-weight: 900; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.1em; cursor: pointer; transition: 0.3s; box-shadow: 0 4px 15px rgba(34, 211, 238, 0.2);"
                        onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 25px rgba(34, 211, 238, 0.4)';"
                        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 15px rgba(34, 211, 238, 0.2)';"
                        onclick="this.innerText='INITIALIZING...'">
                    Confirm Arena Deployment
                </button>

                <a href="{{ route('admin.courts.index') }}" 
                   style="text-align: center; color: #475569; text-decoration: none; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.1em; transition: 0.3s;"
                   onmouseover="this.style.color='#94a3b8';"
                   onmouseout="this.style.color='#475569';">
                    Cancel Deployment
                </a>
            </div>
        </form>
    </div>

    {{-- System Status Tag --}}
    <div style="margin-top: 1.5rem; text-align: center;">
        <span style="font-family: 'JetBrains Mono', monospace; font-size: 10px; color: #334155; text-transform: uppercase; letter-spacing: 0.2em;">
            Ready for Data Entry // Nexus_v3.0
        </span>
    </div>
</div>

<style>
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endsection