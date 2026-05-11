@extends('layouts.app')

@section('title', 'Neural Feed')
@section('header', 'System Broadcasts')
@section('subheader', 'Real-time intelligence and community updates')

@section('content')
<div style="display: flex; flex-direction: column; gap: 1.5rem; animation: fadeIn 0.8s ease-out;">

    @forelse($announcements as $a)
        {{-- Transmission Card --}}
        <div style="background: rgba(30, 41, 41, 0.4); backdrop-filter: blur(20px); border: 1px solid rgba(34, 211, 238, 0.1); border-left: 4px solid #22d3ee; border-radius: 16px; padding: 1.5rem; position: relative; overflow: hidden; transition: 0.3s;"
             onmouseover="this.style.background='rgba(30, 41, 59, 0.6)'; this.style.transform='translateX(5px)';"
             onmouseout="this.style.background='rgba(30, 41, 41, 0.4)'; this.style.transform='translateX(0)';">
            
            {{-- Data Header --}}
            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 1rem;">
                <div>
                    <h3 style="color: #fff; font-weight: 800; font-size: 1.1rem; margin: 0; letter-spacing: -0.01em;">
                        {{ $a->title }}
                    </h3>
                    <div style="display: flex; align-items: center; gap: 10px; margin-top: 5px;">
                        <span style="font-family: 'JetBrains Mono', monospace; font-size: 10px; color: #22d3ee; text-transform: uppercase; letter-spacing: 0.1em;">
                            Origin: {{ $a->user->name }}
                        </span>
                        <span style="width: 4px; height: 4px; border-radius: 50%; background: #475569;"></span>
                        <span style="font-family: 'JetBrains Mono', monospace; font-size: 10px; color: #64748b;">
                            {{ $a->created_at->diffForHumans() }}
                        </span>
                    </div>
                </div>
                
                {{-- Status Pulse --}}
                <div style="display: flex; align-items: center; gap: 8px; background: rgba(34, 211, 238, 0.05); padding: 4px 10px; border-radius: 20px; border: 1px solid rgba(34, 211, 238, 0.1);">
                    <div style="width: 6px; height: 6px; border-radius: 50%; background: #22d3ee; box-shadow: 0 0 8px #22d3ee; animation: pulse 2s infinite;"></div>
                    <span style="font-size: 8px; font-weight: 900; color: #22d3ee; text-transform: uppercase;">Live Feed</span>
                </div>
            </div>

            {{-- Message Body --}}
            <div style="color: #cbd5e1; font-size: 0.95rem; line-height: 1.6; white-space: pre-line; border-top: 1px solid rgba(255, 255, 255, 0.03); padding-top: 1rem;">
                {{ $a->body }}
            </div>

            {{-- Decorative Tech Lines --}}
            <div style="position: absolute; bottom: 0; right: 0; opacity: 0.1;">
                <svg width="60" height="60" viewBox="0 0 60 60" fill="none">
                    <path d="M60 0V60H0" stroke="#22d3ee" stroke-width="2"/>
                </svg>
            </div>
        </div>

    @empty
        {{-- Empty State / No Signal --}}
        <div style="padding: 8rem 2rem; text-align: center; background: rgba(30, 41, 59, 0.2); border: 1px dashed rgba(255, 255, 255, 0.05); border-radius: 24px;">
            <div style="font-size: 2rem; margin-bottom: 1rem; filter: grayscale(1); opacity: 0.3;">📡</div>
            <p style="color: #475569; font-family: 'JetBrains Mono', monospace; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.3em;">
                Signal_Lost: No_Active_Broadcasts
            </p>
        </div>
    @endforelse

    {{-- Pagination Registry --}}
    @if($announcements->hasPages())
        <div style="margin-top: 2rem; padding: 1rem; display: flex; justify-content: center; background: rgba(30, 41, 59, 0.2); border-radius: 12px;">
            {{ $announcements->links() }}
        </div>
    @endif

</div>

<style>
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(15px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @keyframes pulse {
        0% { opacity: 0.4; }
        50% { opacity: 1; }
        100% { opacity: 0.4; }
    }
    /* Customization for Laravel Pagination */
    .pagination { display: flex; gap: 5px; }
    .page-item.active .page-link { background: #22d3ee; border-color: #22d3ee; color: #0f172a; }
    .page-link { background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); color: #fff; border-radius: 8px; }
</style>
@endsection