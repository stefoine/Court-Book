@extends('layouts.app')

@section('title', 'Manage Bookings')
@section('header', 'Operations Registry')
@section('subheader', 'Centralized Booking Manifest & Validation')

@section('content')
<div style="animation: fadeIn 0.8s ease-out;">

    {{-- Filter Terminal --}}
    <div style="background: rgba(30, 41, 59, 0.4); backdrop-filter: blur(20px); border: 1px solid rgba(255, 255, 255, 0.05); border-radius: 20px; padding: 1.25rem; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 1rem;">
        <form method="GET" style="display: flex; flex-wrap: wrap; gap: 1rem; width: 100%;">
            <div style="position: relative; flex: 1; min-width: 200px;">
                <input style="width: 100%; background: rgba(15, 23, 42, 0.6); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 10px; padding: 0.65rem 1rem; color: #fff; font-size: 0.85rem; outline: none; transition: 0.3s;" 
                       name="search" value="{{ request('search') }}" placeholder="Search user identity..."
                       onfocus="this.style.borderColor='#22d3ee'; this.style.boxShadow='0 0 10px rgba(34, 211, 238, 0.2)';"
                       onblur="this.style.borderColor='rgba(255, 255, 255, 0.1)'; this.style.boxShadow='none';">
            </div>

            <select name="status" style="background: rgba(15, 23, 42, 0.6); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 10px; padding: 0.65rem 1rem; color: #fff; font-size: 0.85rem; outline: none; min-width: 150px; cursor: pointer;">
                <option value="" style="background: #1e293b;">All Statuses</option>
                @foreach(['pending','approved','rejected','cancelled','completed'] as $s)
                    <option value="{{ $s }}" @selected(request('status')===$s) style="background: #1e293b;">{{ ucfirst($s) }}</option>
                @endforeach
            </select>

            <button style="background: rgba(34, 211, 238, 0.1); color: #22d3ee; border: 1px solid rgba(34, 211, 238, 0.2); padding: 0.65rem 1.5rem; border-radius: 10px; font-weight: 800; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.1em; cursor: pointer; transition: 0.3s;"
                    onmouseover="this.style.background='rgba(34, 211, 238, 0.2)'; this.style.color='#fff';"
                    onmouseout="this.style.background='rgba(34, 211, 238, 0.1)'; this.style.color='#22d3ee';">
                Filter Stream
            </button>
        </form>
    </div>

    {{-- Data Table Terminal --}}
    <div style="background: rgba(30, 41, 59, 0.3); backdrop-filter: blur(20px); border: 1px solid rgba(255, 255, 255, 0.05); border-radius: 24px; overflow: hidden; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);">
        <div style="overflow-x: auto; padding: 1rem;">
            <table style="width: 100%; border-collapse: separate; border-spacing: 0 8px;">
                <thead>
                    <tr style="text-align: left;">
                        <th style="padding: 1rem; font-size: 10px; color: #475569; text-transform: uppercase; letter-spacing: 0.2em; font-weight: 800;">Log ID</th>
                        <th style="padding: 1rem; font-size: 10px; color: #475569; text-transform: uppercase; letter-spacing: 0.2em; font-weight: 800;">Entity / Court</th>
                        <th style="padding: 1rem; font-size: 10px; color: #475569; text-transform: uppercase; letter-spacing: 0.2em; font-weight: 800;">Temporal Data</th>
                        <th style="padding: 1rem; font-size: 10px; color: #475569; text-transform: uppercase; letter-spacing: 0.2em; font-weight: 800;">Status</th>
                        <th style="padding: 1rem; font-size: 10px; color: #475569; text-transform: uppercase; letter-spacing: 0.2em; font-weight: 800; text-align: right;">Operations</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($bookings as $b)
                    <tr style="background: rgba(255, 255, 255, 0.02); transition: 0.3s;" 
                        onmouseover="this.style.background='rgba(255, 255, 255, 0.05)';" 
                        onmouseout="this.style.background='rgba(255, 255, 255, 0.02)';">
                        
                        <td style="padding: 1.25rem 1rem; border-radius: 16px 0 0 16px;">
                            <span style="font-family: 'JetBrains Mono', monospace; color: #475569; font-size: 0.75rem;">#BK-{{ $b->id }}</span>
                        </td>
                        
                        <td style="padding: 1.25rem 1rem;">
                            <div style="color: #fff; font-weight: 700; font-size: 0.9rem; margin-bottom: 2px;">{{ $b->user->name }}</div>
                            <div style="color: #22d3ee; font-size: 0.75rem; opacity: 0.8; font-weight: 600;">{{ $b->court->name }}</div>
                        </td>
                        
                        <td style="padding: 1.25rem 1rem;">
                            <div style="color: #cbd5e1; font-size: 0.85rem; font-weight: 600;">{{ $b->booking_date->format('M d, Y') }}</div>
                            <div style="color: #475569; font-size: 0.75rem;">{{ \Illuminate\Support\Carbon::parse($b->start_time)->format('H:i') }} Terminal</div>
                        </td>
                        
                        <td style="padding: 1.25rem 1rem;">
                            <span style="padding: 4px 12px; border-radius: 20px; font-size: 10px; font-weight: 800; text-transform: uppercase; border: 1px solid currentColor;
                                @if($b->status === 'approved') color: #10b981; background: rgba(16, 185, 129, 0.1); 
                                @elseif($b->status === 'pending') color: #f59e0b; background: rgba(245, 158, 11, 0.1);
                                @elseif($b->status === 'completed') color: #3b82f6; background: rgba(59, 130, 246, 0.1);
                                @else color: #f43f5e; background: rgba(244, 63, 94, 0.1); 
                                @endif">
                                {{ ucfirst($b->status) }}
                            </span>
                        </td>
                        
                        <td style="padding: 1.25rem 1rem; text-align: right; border-radius: 0 16px 16px 0;">
                            <div style="display: inline-flex; gap: 8px; align-items: center;">
                                <a href="{{ route('admin.bookings.show',$b) }}" style="color: #fff; background: rgba(255,255,255,0.05); padding: 6px 12px; border-radius: 8px; text-decoration: none; font-size: 10px; font-weight: 800; text-transform: uppercase; border: 1px solid rgba(255,255,255,0.1); transition: 0.2s;" onmouseover="this.style.background='rgba(255,255,255,0.15)'" onmouseout="this.style.background='rgba(255,255,255,0.05)'">View</a>
                                
                                @if($b->status==='pending')
                                    <form method="POST" action="{{ route('admin.bookings.approve',$b) }}" style="display: inline;">
                                        @csrf
                                        <button style="color: #10b981; background: rgba(16, 185, 129, 0.15); border: 1px solid rgba(16, 185, 129, 0.3); padding: 6px 12px; border-radius: 8px; font-size: 10px; font-weight: 800; text-transform: uppercase; cursor: pointer; transition: 0.2s;" onmouseover="this.style.background='rgba(16, 185, 129, 0.25)'" onmouseout="this.style.background='rgba(16, 185, 129, 0.15)'">Approve</button>
                                    </form>
                                    <form method="POST" action="{{ route('admin.bookings.reject',$b) }}" style="display: inline;">
                                        @csrf
                                        <button style="color: #f43f5e; background: rgba(244, 63, 94, 0.1); border: 1px solid rgba(244, 63, 94, 0.2); padding: 6px 12px; border-radius: 8px; font-size: 10px; font-weight: 800; text-transform: uppercase; cursor: pointer; transition: 0.2s;" onmouseover="this.style.background='rgba(244, 63, 94, 0.2)'" onmouseout="this.style.background='rgba(244, 63, 94, 0.1)'">Reject</button>
                                    </form>
                                @endif

                                @if($b->status==='approved')
                                    <form method="POST" action="{{ route('admin.bookings.complete',$b) }}" style="display: inline;">
                                        @csrf
                                        <button style="color: #3b82f6; background: rgba(59, 130, 246, 0.15); border: 1px solid rgba(59, 130, 246, 0.3); padding: 6px 12px; border-radius: 8px; font-size: 10px; font-weight: 800; text-transform: uppercase; cursor: pointer;">Complete</button>
                                    </form>
                                @endif

                                <form method="POST" action="{{ route('admin.bookings.destroy',$b) }}" style="display: inline;">
                                    @csrf @method('DELETE')
                                    <button onclick="return confirm('Wipe record #{{ $b->id }}?')" style="color: #f43f5e; background: transparent; border: none; font-size: 10px; font-weight: 800; text-transform: uppercase; cursor: pointer; opacity: 0.6; transition: 0.2s;" onmouseover="this.style.opacity='1';" onmouseout="this.style.opacity='0.6';">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Pagination Terminal --}}
    <div style="margin-top: 1.5rem; display: flex; justify-content: center;">
        {{ $bookings->links() }}
    </div>
</div>

<style>
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    /* Simple Tailwind-like pagination centering if needed */
    nav[role="navigation"] { display: flex; justify-content: center; width: 100%; }
</style>
@endsection