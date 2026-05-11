@extends('layouts.app')

@section('title', 'User Dashboard')
@section('header', 'Command Center')
@section('subheader', 'Real-time booking metrics and upcoming operations')

@section('content')
<div style="animation: fadeIn 0.8s ease-out;">

    {{-- Stats Grid --}}
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.5rem; margin-bottom: 2rem;">
        @php $cards = [
            ['Total Operations', $stats['total'], '#22d3ee', '0 0 15px rgba(34, 211, 238, 0.3)'],
            ['Approved Access',  $stats['approved'], '#10b981', '0 0 15px rgba(16, 185, 129, 0.3)'],
            ['Pending Validation', $stats['pending'], '#f59e0b', '0 0 15px rgba(245, 158, 11, 0.3)'],
            ['Completed Missions', $stats['completed'], '#6366f1', '0 0 15px rgba(99, 102, 241, 0.3)'],
        ]; @endphp

        @foreach($cards as [$label,$val,$color,$glow])
            <div style="background: rgba(30, 41, 59, 0.4); backdrop-filter: blur(20px); border: 1px solid rgba(255, 255, 255, 0.05); border-radius: 20px; padding: 1.5rem; transition: 0.3s;"
                 onmouseover="this.style.transform='translateY(-5px)'; this.style.borderColor='{{ $color }}';"
                 onmouseout="this.style.transform='translateY(0)'; this.style.borderColor='rgba(255, 255, 255, 0.05)';" >
                <div style="width: 12px; height: 12px; border-radius: 50%; background: {{ $color }}; box-shadow: {{ $glow }}; margin-bottom: 1rem;"></div>
                <p style="font-size: 10px; font-weight: 800; color: #475569; text-transform: uppercase; letter-spacing: 0.1em; margin: 0;">{{ $label }}</p>
                <p style="font-size: 2rem; font-weight: 900; color: #fff; margin: 0.5rem 0 0 0;">{{ $val }}</p>
            </div>
        @endforeach
    </div>

    {{-- Upcoming Bookings Registry --}}
    <div style="background: rgba(30, 41, 59, 0.3); backdrop-filter: blur(20px); border: 1px solid rgba(255, 255, 255, 0.05); border-radius: 24px; overflow: hidden; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);">
        <div style="padding: 1.5rem 2rem; border-bottom: 1px solid rgba(255, 255, 255, 0.05); display: flex; justify-content: space-between; align-items: center;">
            <h3 style="color: #fff; font-size: 0.9rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.1em; margin: 0;">Upcoming Operations</h3>
            <a href="{{ route('bookings.create') }}" 
               style="background: #22d3ee; color: #0f172a; text-decoration: none; padding: 0.6rem 1.25rem; border-radius: 10px; font-weight: 800; font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.05em; transition: 0.3s;"
               onmouseover="this.style.boxShadow='0 0 15px rgba(34, 211, 238, 0.5)';"
               onmouseout="this.style.boxShadow='none';">
                + New Booking Protocol
            </a>
        </div>

        <div style="padding: 1rem;">
            @if($upcoming->isEmpty())
                <div style="padding: 3rem; text-align: center;">
                    <p style="color: #475569; font-size: 0.85rem; font-style: italic;">No active operations scheduled. Initialize a new booking to proceed.</p>
                </div>
            @else
                <div style="overflow-x: auto;">
                    <table style="width: 100%; border-collapse: separate; border-spacing: 0 8px;">
                        <thead>
                            <tr style="text-align: left;">
                                <th style="padding: 0.75rem 1rem; font-size: 10px; color: #475569; text-transform: uppercase; letter-spacing: 0.1em;">Target Arena</th>
                                <th style="padding: 0.75rem 1rem; font-size: 10px; color: #475569; text-transform: uppercase; letter-spacing: 0.1em;">Sport Class</th>
                                <th style="padding: 0.75rem 1rem; font-size: 10px; color: #475569; text-transform: uppercase; letter-spacing: 0.1em;">Temporal Data</th>
                                <th style="padding: 0.75rem 1rem; font-size: 10px; color: #475569; text-transform: uppercase; letter-spacing: 0.1em;">Status</th>
                                <th style="padding: 0.75rem 1rem; text-align: right;"></th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($upcoming as $b)
                            <tr style="background: rgba(255, 255, 255, 0.02); transition: 0.3s;" 
                                onmouseover="this.style.background='rgba(255, 255, 255, 0.05)';" 
                                onmouseout="this.style.background='rgba(255, 255, 255, 0.02)';">
                                <td style="padding: 1rem; border-radius: 12px 0 0 12px;">
                                    <div style="color: #fff; font-weight: 700; font-size: 0.85rem;">{{ $b->court->name }}</div>
                                </td>
                                <td style="padding: 1rem;">
                                    <div style="color: #22d3ee; font-size: 0.75rem; font-weight: 600;">{{ $b->sport_type }}</div>
                                </td>
                                <td style="padding: 1rem;">
                                    <div style="color: #cbd5e1; font-size: 0.8rem;">{{ $b->booking_date->format('M d, Y') }}</div>
                                    <div style="color: #475569; font-size: 0.7rem; font-family: 'JetBrains Mono', monospace;">{{ \Illuminate\Support\Carbon::parse($b->start_time)->format('H:i') }} - {{ \Illuminate\Support\Carbon::parse($b->end_time)->format('H:i') }}</div>
                                </td>
                                <td style="padding: 1rem;">
                                    <span style="padding: 4px 10px; border-radius: 20px; font-size: 9px; font-weight: 800; text-transform: uppercase; border: 1px solid currentColor;
                                        @if($b->status === 'approved') color: #10b981; background: rgba(16, 185, 129, 0.1); 
                                        @elseif($b->status === 'pending') color: #f59e0b; background: rgba(245, 158, 11, 0.1);
                                        @else color: #f43f5e; background: rgba(244, 63, 94, 0.1); 
                                        @endif">
                                        {{ $b->status }}
                                    </span>
                                </td>
                                <td style="padding: 1rem; text-align: right; border-radius: 0 12px 12px 0;">
                                    <a href="{{ route('bookings.show', $b) }}" 
                                       style="color: #475569; text-decoration: none; font-size: 10px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.05em; transition: 0.2s;"
                                       onmouseover="this.style.color='#fff'"
                                       onmouseout="this.style.color='#475569'">View Manifest</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>

<style>
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(15px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endsection