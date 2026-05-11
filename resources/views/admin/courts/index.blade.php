@extends('layouts.app')

@section('title', 'Sector Management')
@section('header', 'Facility Control')
@section('subheader', 'High-level oversight of all available operational sectors')

@section('content')
<div style="animation: fadeIn 0.8s cubic-bezier(0.4, 0, 0.2, 1);">

    {{-- System Command Bar --}}
    <div style="background: rgba(15, 23, 42, 0.4); backdrop-filter: blur(20px); border: 1px solid rgba(34, 211, 238, 0.1); border-radius: 24px; padding: 1.5rem; margin-bottom: 2rem; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 10px 40px -10px rgba(0,0,0,0.5);">
        <div>
            <h3 style="color: #fff; font-size: 1.1rem; font-weight: 800; letter-spacing: -0.01em; margin: 0;">Operational Registry</h3>
            <div style="font-family: 'JetBrains Mono', monospace; font-size: 10px; color: #475569; text-transform: uppercase; margin-top: 4px;">Verified_Sectors: {{ $courts->total() }}</div>
        </div>
        
        <a href="{{ route('admin.courts.create') }}" 
           style="background: linear-gradient(135deg, #22d3ee 0%, #0891b2 100%); color: #0f172a; text-decoration: none; padding: 0.8rem 1.5rem; border-radius: 12px; font-weight: 900; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.1em; box-shadow: 0 0 20px rgba(34, 211, 238, 0.2); transition: 0.3s;"
           onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 5px 25px rgba(34, 211, 238, 0.4)';"
           onmouseout="this.style.transform='translateY(0)';"
        >
            + Deploy New Sector
        </a>
    </div>

    {{-- Data Grid --}}
    <div style="background: rgba(30, 41, 59, 0.2); backdrop-filter: blur(20px); border: 1px solid rgba(255, 255, 255, 0.03); border-radius: 28px; overflow: hidden;">
        <div style="overflow-x: auto; padding: 1rem;">
            <table style="width: 100%; border-collapse: separate; border-spacing: 0 12px;">
                <thead>
                    <tr style="text-align: left;">
                        <th style="padding: 0 1rem; font-size: 9px; color: #475569; text-transform: uppercase; letter-spacing: 0.2em; font-weight: 900;">Sector Identity</th>
                        <th style="padding: 0 1rem; font-size: 9px; color: #475569; text-transform: uppercase; letter-spacing: 0.2em; font-weight: 900;">Class / Type</th>
                        <th style="padding: 0 1rem; font-size: 9px; color: #475569; text-transform: uppercase; letter-spacing: 0.2em; font-weight: 900;">Capacity</th>
                        <th style="padding: 0 1rem; font-size: 9px; color: #475569; text-transform: uppercase; letter-spacing: 0.2em; font-weight: 900;">Credit Rate</th>
                        <th style="padding: 0 1rem; font-size: 9px; color: #475569; text-transform: uppercase; letter-spacing: 0.2em; font-weight: 900;">Status</th>
                        <th style="padding: 0 1rem;"></th>
                    </tr>
                </thead>
                <tbody>
                @foreach($courts as $c)
                    <tr style="background: rgba(255, 255, 255, 0.01); border: 1px solid rgba(255,255,255,0.03); transition: 0.4s;" 
                        onmouseover="this.style.background='rgba(255, 255, 255, 0.04)';" 
                        onmouseout="this.style.background='rgba(255, 255, 255, 0.01)';"
                    >
                        {{-- Sector Name --}}
                        <td style="padding: 1.25rem 1rem; border-radius: 16px 0 0 16px;">
                            <div style="color: #fff; font-weight: 700; font-size: 0.9rem;">{{ $c->name }}</div>
                            <div style="color: #475569; font-size: 0.7rem; font-family: 'JetBrains Mono', monospace;">ID: SECTOR_{{ $c->id }}</div>
                        </td>

                        {{-- Type --}}
                        <td style="padding: 1.25rem 1rem;">
                            <span style="color: #cbd5e1; font-size: 0.8rem; font-weight: 600; text-transform: uppercase;">{{ $c->type }}</span>
                        </td>

                        {{-- Capacity --}}
                        <td style="padding: 1.25rem 1rem;">
                            <div style="color: #fff; font-weight: 800; font-size: 0.9rem;">{{ $c->capacity }}</div>
                            <div style="color: #475569; font-size: 0.65rem; text-transform: uppercase;">Units Max</div>
                        </td>

                        {{-- Rate --}}
                        <td style="padding: 1.25rem 1rem;">
                            <div style="color: #22d3ee; font-weight: 800; font-size: 0.9rem; font-family: 'JetBrains Mono', monospace;">₱{{ number_format($c->hourly_rate,2) }}</div>
                            <div style="color: #475569; font-size: 0.65rem; text-transform: uppercase;">Per Solar Hour</div>
                        </td>

                        {{-- Status --}}
                        <td style="padding: 1.25rem 1rem;">
                            <span style="display: inline-flex; align-items: center; gap: 6px; padding: 5px 12px; border-radius: 8px; font-size: 9px; font-weight: 900; text-transform: uppercase; letter-spacing: 0.05em; border: 1px solid currentColor;
                                @if($c->is_available) color: #10b981; background: rgba(16, 185, 129, 0.05); @else color: #f43f5e; background: rgba(244, 63, 94, 0.05); @endif">
                                <span style="width: 4px; height: 4px; border-radius: 50%; background: currentColor; box-shadow: 0 0 8px currentColor;"></span>
                                {{ $c->is_available ? 'Active' : 'Offline' }}
                            </span>
                        </td>

                        {{-- Actions --}}
                        <td style="padding: 1.25rem 1rem; text-align: right; border-radius: 0 16px 16px 0;">
                            <div style="display: inline-flex; gap: 15px; align-items: center;">
                                <a href="{{ route('admin.courts.edit',$c) }}" 
                                   style="color: #cbd5e1; text-decoration: none; font-size: 10px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.1em; transition: 0.2s;" 
                                   onmouseover="this.style.color='#f59e0b'"
                                >Reconfigure</a>
                                
                                <form method="POST" action="{{ route('admin.courts.destroy',$c) }}" style="display: inline;">
                                    @csrf @method('DELETE')
                                    <button style="background: none; border: none; color: #475569; cursor: pointer; font-size: 10px; font-weight: 800; text-transform: uppercase; transition: 0.2s;" 
                                            onclick="return confirm('Purge this sector from registry?')"
                                            onmouseover="this.style.color='#f43f5e'"
                                    >Purge</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Pagination Registry --}}
    @if($courts->hasPages())
        <div style="margin-top: 2rem; display: flex; justify-content: center; opacity: 0.6;">
            {{ $courts->links() }}
        </div>
    @endif
</div>

<style>
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(15px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endsection