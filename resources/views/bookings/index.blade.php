@extends('layouts.app')

@section('title', 'My Operations')
@section('header', 'Operational Registry')
@section('subheader', 'Accessing personal reservation data stream')

@section('content')
<div style="animation: fadeIn 0.8s ease-out;">

    {{-- Universal Command Console (Filter) --}}
    <div style="background: rgba(15, 23, 42, 0.4); backdrop-filter: blur(20px); border: 1px solid rgba(34, 211, 238, 0.1); border-radius: 24px; padding: 1.5rem; margin-bottom: 2rem; box-shadow: 0 10px 40px -10px rgba(0,0,0,0.5);">
        <form method="GET" style="display: flex; flex-wrap: wrap; gap: 1rem; align-items: center;">
            <div style="position: relative; flex: 1; min-width: 280px;">
                <input style="width: 100%; background: rgba(0, 0, 0, 0.3); border: 1px solid rgba(255, 255, 255, 0.05); border-radius: 12px; padding: 0.8rem 1rem; color: #fff; font-size: 0.85rem; outline: none; transition: 0.3s;" 
                       name="search" value="{{ request('search') }}" placeholder="Scan purpose code..." autocomplete="off"
                       onfocus="this.style.borderColor='#22d3ee'; this.style.boxShadow='0 0 15px rgba(34, 211, 238, 0.1)';">
            </div>
            
            <select name="status" style="width: 180px; background: rgba(0, 0, 0, 0.3); border: 1px solid rgba(255, 255, 255, 0.05); border-radius: 12px; padding: 0.8rem; color: #cbd5e1; font-size: 0.85rem; outline: none; cursor: pointer;">
                <option value="">All Protocols</option>
                @foreach(['pending','approved','rejected','cancelled','completed'] as $s)
                    <option value="{{ $s }}" @selected(request('status')===$s)>{{ ucfirst($s) }}</option>
                @endforeach
            </select>
            
            <button type="submit" style="background: rgba(34, 211, 238, 0.1); color: #22d3ee; border: 1px solid rgba(34, 211, 238, 0.2); padding: 0.8rem 1.5rem; border-radius: 12px; font-weight: 800; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.1em; cursor: pointer; transition: 0.3s;"
                    onmouseover="this.style.background='rgba(34, 211, 238, 0.2)'; this.style.transform='translateY(-1px)';"
                    onmouseout="this.style.background='rgba(34, 211, 238, 0.1)';">
                Sync Filter
            </button>

            <a href="{{ route('bookings.create') }}" 
               style="margin-left: auto; background: linear-gradient(135deg, #22d3ee 0%, #0891b2 100%); color: #0f172a; text-decoration: none; padding: 0.8rem 1.5rem; border-radius: 12px; font-weight: 900; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.1em; box-shadow: 0 0 20px rgba(34, 211, 238, 0.2); transition: 0.3s;"
               onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 5px 25px rgba(34, 211, 238, 0.4)';"
               onmouseout="this.style.transform='translateY(0)';">
                 + Initiate Booking
            </a>
        </form>
    </div>

    {{-- Data Stream Registry --}}
    <div style="background: rgba(30, 41, 59, 0.2); backdrop-filter: blur(20px); border: 1px solid rgba(255, 255, 255, 0.03); border-radius: 28px; overflow: hidden;">
        
        @if($bookings->isEmpty())
            <div style="padding: 8rem 2rem; text-align: center;">
                <div style="font-size: 2.5rem; margin-bottom: 1rem; filter: drop-shadow(0 0 10px rgba(148, 163, 184, 0.5));">📡</div>
                <p style="color: #475569; font-family: 'JetBrains Mono', monospace; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.4em;">
                    Status: No_Data_Found
                </p>
            </div>
        @else
            <div style="overflow-x: auto; padding: 1rem;">
                <table style="width: 100%; border-collapse: separate; border-spacing: 0 12px;">
                    <thead>
                        <tr style="text-align: left;">
                            <th style="padding: 0 1rem; font-size: 9px; color: #475569; text-transform: uppercase; letter-spacing: 0.2em; font-weight: 900;">Sector / Class</th>
                            <th style="padding: 0 1rem; font-size: 9px; color: #475569; text-transform: uppercase; letter-spacing: 0.2em; font-weight: 900;">Temporal Window</th>
                            <th style="padding: 0 1rem; font-size: 9px; color: #475569; text-transform: uppercase; letter-spacing: 0.2em; font-weight: 900;">Resource Credits</th>
                            <th style="padding: 0 1rem; font-size: 9px; color: #475569; text-transform: uppercase; letter-spacing: 0.2em; font-weight: 900;">Protocol Status</th>
                            <th style="padding: 0 1rem;"></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($bookings as $b)
                        <tr style="background: rgba(255, 255, 255, 0.01); border: 1px solid rgba(255,255,255,0.03); transition: 0.4s; border-radius: 16px;" 
                            onmouseover="this.style.background='rgba(255, 255, 255, 0.04)'; this.style.transform='scale(1.002)';" 
                            onmouseout="this.style.background='rgba(255, 255, 255, 0.01)'; this.style.transform='scale(1)';">
                            
                            <td style="padding: 1.25rem 1rem; border-radius: 16px 0 0 16px;">
                                <div style="color: #fff; font-weight: 700; font-size: 0.9rem;">{{ $b->court->name }}</div>
                                <div style="color: #22d3ee; font-size: 0.7rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.05em; font-family: 'JetBrains Mono', monospace;">{{ $b->sport_type }}</div>
                            </td>
                            
                            <td style="padding: 1.25rem 1rem;">
                                <div style="color: #cbd5e1; font-size: 0.8rem; font-weight: 600;">{{ $b->booking_date->format('M d, Y') }}</div>
                                <div style="color: #475569; font-size: 0.75rem;">{{ \Illuminate\Support\Carbon::parse($b->start_time)->format('H:i') }} – {{ \Illuminate\Support\Carbon::parse($b->end_time)->format('H:i') }}</div>
                            </td>
                            
                            <td style="padding: 1.25rem 1rem;">
                                <div style="color: #fff; font-weight: 800; font-size: 0.9rem; font-family: 'JetBrains Mono', monospace;">₱{{ number_format($b->total_price,2) }}</div>
                            </td>
                            
                            <td style="padding: 1.25rem 1rem;">
                                <span style="display: inline-flex; align-items: center; gap: 6px; padding: 6px 12px; border-radius: 10px; font-size: 9px; font-weight: 900; text-transform: uppercase; letter-spacing: 0.05em; border: 1px solid currentColor;
                                    @if($b->status === 'approved') color: #10b981; background: rgba(16, 185, 129, 0.05); 
                                    @elseif($b->status === 'pending') color: #f59e0b; background: rgba(245, 158, 11, 0.05);
                                    @elseif($b->status === 'completed') color: #6366f1; background: rgba(99, 102, 241, 0.05);
                                    @else color: #f43f5e; background: rgba(244, 63, 94, 0.05); @endif">
                                    <span style="width: 5px; height: 5px; border-radius: 50%; background: currentColor; box-shadow: 0 0 8px currentColor;"></span>
                                    {{ $b->status }}
                                </span>
                            </td>
                            
                            <td style="padding: 1.25rem 1rem; text-align: right; border-radius: 0 16px 16px 0;">
                                <div style="display: inline-flex; gap: 15px; align-items: center;">
                                    <a href="{{ route('bookings.show',$b) }}" style="color: #fff; text-decoration: none; font-size: 10px; font-weight: 900; text-transform: uppercase; letter-spacing: 0.1em; transition: 0.2s;" onmouseover="this.style.color='#22d3ee'">Review</a>
                                    
                                    @can('update', $b) 
                                        <a href="{{ route('bookings.edit',$b) }}" style="color: #64748b; text-decoration: none; font-size: 10px; font-weight: 800; text-transform: uppercase; transition: 0.2s;" onmouseover="this.style.color='#f59e0b'">Edit</a> 
                                    @endcan
                                    
                                    @can('cancel', $b)
                                        <form method="POST" action="{{ route('bookings.cancel',$b) }}" style="display: inline;">@csrf
                                            <button style="background: none; border: none; color: #475569; cursor: pointer; font-size: 10px; font-weight: 800; text-transform: uppercase; transition: 0.2s;" 
                                                    onclick="return confirm('Abort operation?')"
                                                    onmouseover="this.style.color='#f43f5e'">
                                                Abort
                                            </button>
                                        </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    {{-- Temporal Pagination --}}
    @if($bookings->hasPages())
        <div style="margin-top: 2rem; display: flex; justify-content: center; opacity: 0.6;">
            {{ $bookings->links() }}
        </div>
    @endif
</div>

<style>
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(15px); }
        to { opacity: 1; transform: translateY(0); }
    }
    /* Simple Customization for Pagination links */
    .pagination { display: flex; list-style: none; gap: 8px; }
    .page-link { background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); color: #fff; border-radius: 8px; padding: 5px 12px; text-decoration: none; font-size: 0.8rem; }
    .active .page-link { background: #22d3ee; color: #0f172a; border-color: #22d3ee; font-weight: 900; }
</style>
@endsection