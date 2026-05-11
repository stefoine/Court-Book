@extends('layouts.app')

@section('title', 'Available Courts')
@section('header', 'Arena Marketplace')
@section('subheader', 'Select a facility to initialize booking protocol')

@section('content')
<div style="animation: fadeIn 0.8s ease-out;">

    {{-- Search & Filter Terminal --}}
    <div style="background: rgba(30, 41, 59, 0.4); backdrop-filter: blur(20px); border: 1px solid rgba(255, 255, 255, 0.05); border-radius: 20px; padding: 1.25rem; margin-bottom: 2rem;">
        <form method="GET" style="display: flex; flex-wrap: wrap; gap: 1rem;">
            <input style="flex: 1; min-width: 250px; background: rgba(15, 23, 42, 0.6); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 12px; padding: 0.75rem 1rem; color: #fff; font-size: 0.85rem; outline: none; transition: 0.3s;" 
                   name="search" value="{{ request('search') }}" placeholder="Search arena name..."
                   onfocus="this.style.borderColor='#22d3ee';">
            
            <input style="width: 200px; background: rgba(15, 23, 42, 0.6); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 12px; padding: 0.75rem 1rem; color: #fff; font-size: 0.85rem; outline: none; transition: 0.3s;" 
                   name="type" value="{{ request('type') }}" placeholder="Filter by type (e.g. Basketball)">
            
            <button style="background: rgba(34, 211, 238, 0.1); color: #22d3ee; border: 1px solid rgba(34, 211, 238, 0.2); padding: 0.75rem 1.5rem; border-radius: 12px; font-weight: 800; font-size: 0.75rem; text-transform: uppercase; cursor: pointer; transition: 0.3s;"
                    onmouseover="this.style.background='rgba(34, 211, 238, 0.2)';">
                Apply Filters
            </button>
        </form>
    </div>

    {{-- Arena Grid --}}
    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 1.5rem;">
        @forelse($courts as $c)
            <div class="court-card" style="background: rgba(30, 41, 59, 0.3); border: 1px solid rgba(255, 255, 255, 0.05); border-radius: 24px; padding: 1.25rem; transition: 0.4s; position: relative; overflow: hidden; display: flex; flex-direction: column;">
                
                {{-- Visual Thumbnail placeholder --}}
                <div style="height: 140px; border-radius: 16px; background: linear-gradient(135deg, rgba(34, 211, 238, 0.1) 0%, rgba(59, 130, 246, 0.1) 100%); margin-bottom: 1.25rem; display: flex; items-center; justify-content: center; font-size: 3rem; border: 1px solid rgba(255,255,255,0.03);">
                    🏟
                </div>

                <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                    <div>
                        <h3 style="margin: 0; color: #fff; font-size: 1.1rem; font-weight: 800; letter-spacing: -0.02em;">{{ $c->name }}</h3>
                        <div style="font-size: 0.7rem; color: #22d3ee; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; margin-top: 2px;">
                            {{ $c->type }} · Capacity: {{ $c->capacity }}
                        </div>
                    </div>
                    <span style="padding: 4px 10px; border-radius: 8px; font-size: 9px; font-weight: 900; text-transform: uppercase; border: 1px solid currentColor;
                        @if($c->is_available) color: #10b981; background: rgba(16, 185, 129, 0.1); 
                        @else color: #f43f5e; background: rgba(244, 63, 94, 0.1); @endif">
                        {{ $c->is_available ? 'Ready' : 'Closed' }}
                    </span>
                </div>

                <p style="color: #94a3b8; font-size: 0.85rem; line-height: 1.5; margin: 1rem 0; flex-grow: 1; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                    {{ $c->description }}
                </p>

                <div style="padding-top: 1.25rem; border-top: 1px solid rgba(255,255,255,0.05); display: flex; justify-content: space-between; align-items: center;">
                    <div>
                        <span style="display: block; font-size: 10px; color: #475569; font-weight: 800; text-transform: uppercase;">Hourly Rate</span>
                        <span style="color: #fff; font-size: 1.1rem; font-weight: 800;">₱{{ number_format($c->hourly_rate, 2) }}</span>
                    </div>
                    <a href="{{ route('courts.show',$c) }}" 
                       style="background: rgba(255, 255, 255, 0.05); color: #fff; text-decoration: none; padding: 0.6rem 1.25rem; border-radius: 10px; font-size: 0.75rem; font-weight: 800; text-transform: uppercase; border: 1px solid rgba(255,255,255,0.1); transition: 0.3s;"
                       onmouseover="this.style.background='#22d3ee'; this.style.color='#0f172a'; this.style.borderColor='#22d3ee';">
                        View Arena
                    </a>
                </div>
            </div>
        @empty
            <div style="grid-column: 1/-1; text-align: center; padding: 4rem; color: #475569;">
                <p>No facilities found in the current registry.</p>
            </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    <div style="margin-top: 3rem; display: flex; justify-content: center; opacity: 0.7;">
        {{ $courts->links() }}
    </div>
</div>

<style>
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(15px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .court-card:hover {
        transform: translateY(-8px);
        background: rgba(30, 41, 59, 0.5) !important;
        border-color: rgba(34, 211, 238, 0.3) !important;
        box-shadow: 0 20px 40px -15px rgba(0, 0, 0, 0.5);
    }
</style>
@endsection