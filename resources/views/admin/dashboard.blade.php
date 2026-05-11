@extends('layouts.app')

@section('title', 'Admin Dashboard')
@section('header', 'System Intelligence')
@section('subheader', 'Core Operations & Data Terminal')

@section('content')
<div style="animation: fadeIn 0.8s ease-out;">

    {{-- TOP STATS GRID --}}
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 1.5rem; margin-bottom: 2rem;">
        @php 
            $stats_data = [
                ['System Users', $stats['users'], 'linear-gradient(135deg, #0f172a 0%, #1e293b 100%)', 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z', '#22d3ee'],
                ['Total Bookings', $stats['bookings'], 'linear-gradient(135deg, #0f172a 0%, #1e293b 100%)', 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z', '#3b82f6'],
                ['Live Sessions', $stats['active_bookings'], 'linear-gradient(135deg, #0f172a 0%, #1e293b 100%)', 'M13 10V3L4 14h7v7l9-11h-7z', '#10b981'],
                ['Facilities', $stats['courts'], 'linear-gradient(135deg, #0f172a 0%, #1e293b 100%)', 'M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10', '#f59e0b'],
            ]; 
        @endphp

        @foreach($stats_data as [$label, $val, $grad, $svg, $color])
            <div style="background: rgba(30, 41, 59, 0.4); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.05); border-radius: 20px; padding: 1.5rem; border-left: 4px solid {{ $color }}; box-shadow: 0 10px 30px rgba(0,0,0,0.2); transition: 0.3s;" 
                 onmouseover="this.style.transform='translateY(-5px)'; this.style.borderColor='rgba(255,255,255,0.1)';" 
                 onmouseout="this.style.transform='translateY(0)';">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <div>
                        <p style="font-size: 10px; font-weight: 800; color: #64748b; text-transform: uppercase; letter-spacing: 0.15em; margin: 0 0 0.25rem 0;">{{ $label }}</p>
                        <p style="font-size: 2rem; font-weight: 900; color: #fff; margin: 0; letter-spacing: -0.05em;">{{ number_format($val) }}</p>
                    </div>
                    <div style="background: {{ $color }}20; color: {{ $color }}; padding: 0.75rem; border-radius: 12px; box-shadow: 0 0 15px {{ $color }}30;">
                        <svg style="width: 1.5rem; height: 1.5rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $svg }}"></path></svg>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 1.5rem; align-items: start;">
        
        {{-- RECENT ACTIVITY LOG --}}
        <div style="background: rgba(30, 41, 59, 0.3); backdrop-filter: blur(20px); border: 1px solid rgba(255, 255, 255, 0.05); border-radius: 24px; overflow: hidden;">
            <div style="padding: 1.5rem; border-bottom: 1px solid rgba(255, 255, 255, 0.05); display: flex; justify-content: space-between; align-items: center;">
                <h3 style="font-size: 0.8rem; font-weight: 800; color: #fff; text-transform: uppercase; letter-spacing: 0.1em; margin: 0;">Live Activity Stream</h3>
                <div style="width: 8px; height: 8px; background: #10b981; border-radius: 50%; box-shadow: 0 0 10px #10b981;"></div>
            </div>
            
            <div style="overflow-x: auto; padding: 1rem;">
                <table style="width: 100%; border-collapse: separate; border-spacing: 0 8px;">
                    <thead>
                        <tr style="text-align: left;">
                            <th style="padding: 0.75rem 1rem; font-size: 10px; color: #475569; text-transform: uppercase; letter-spacing: 0.1em;">Account</th>
                            <th style="padding: 0.75rem 1rem; font-size: 10px; color: #475569; text-transform: uppercase; letter-spacing: 0.1em;">Court</th>
                            <th style="padding: 0.75rem 1rem; font-size: 10px; color: #475569; text-transform: uppercase; letter-spacing: 0.1em;">Status</th>
                            <th style="padding: 0.75rem 1rem; text-align: right;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recent as $b)
                            <tr style="background: rgba(255,255,255,0.02); transition: 0.2s;" onmouseover="this.style.background='rgba(255,255,255,0.05)';" onmouseout="this.style.background='rgba(255,255,255,0.02)';">
                                <td style="padding: 1rem; border-radius: 12px 0 0 12px;">
                                    <div style="color: #fff; font-weight: 700; font-size: 0.9rem;">{{ $b->user->name }}</div>
                                    <div style="color: #475569; font-size: 10px;">ID: #UX-{{ $b->id }}</div>
                                </td>
                                <td style="padding: 1rem; color: #cbd5e1; font-size: 0.85rem;">{{ $b->court->name }}</td>
                                <td style="padding: 1rem;">
                                    <span style="padding: 4px 10px; border-radius: 6px; font-size: 9px; font-weight: 800; text-transform: uppercase; border: 1px solid currentColor;
                                        @if($b->status == 'approved') color: #10b981; background: rgba(16, 185, 129, 0.1); 
                                        @elseif($b->status == 'pending') color: #f59e0b; background: rgba(245, 158, 11, 0.1);
                                        @else color: #94a3b8; background: rgba(148, 163, 184, 0.1); @endif">
                                        {{ $b->status }}
                                    </span>
                                </td>
                                <td style="padding: 1rem; text-align: right; border-radius: 0 12px 12px 0;">
                                    <a href="{{ route('admin.bookings.show', $b) }}" style="color: #22d3ee; font-size: 10px; font-weight: 800; text-decoration: none; text-transform: uppercase; border: 1px solid rgba(34, 211, 238, 0.2); padding: 4px 12px; border-radius: 6px; transition: 0.3s;" 
                                       onmouseover="this.style.background='#22d3ee'; this.style.color='#0f172a';">Manage</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- SIDE PANELS --}}
        <div style="display: flex; flex-direction: column; gap: 1.5rem;">
            
            {{-- PEAK MARKET --}}
            <div style="background: linear-gradient(135deg, #0891b2 0%, #0e7490 100%); border-radius: 24px; padding: 1.5rem; color: #fff; box-shadow: 0 0 30px rgba(8, 145, 178, 0.3);">
                <div style="font-size: 10px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.2em; color: rgba(255,255,255,0.7); margin-bottom: 1rem;">Peak Demand</div>
                <div style="font-size: 1.75rem; font-weight: 900; margin-bottom: 0.25rem;">{{ $mostBookedSport->sport_type ?? 'N/A' }}</div>
                <div style="font-size: 11px; font-weight: 700; color: #22d3ee; text-transform: uppercase;">Most Booked Category</div>
                
                <div style="margin-top: 1.5rem; padding: 1rem; background: rgba(0,0,0,0.2); border-radius: 12px; display: flex; justify-content: space-between; align-items: center;">
                    <span style="font-size: 12px; color: rgba(255,255,255,0.8);">Total Entry Log</span>
                    <span style="font-size: 1.25rem; font-weight: 900;">{{ $mostBookedSport->total ?? 0 }}</span>
                </div>
            </div>

            {{-- OPERATIONAL FLOW --}}
            <div style="background: rgba(30, 41, 59, 0.3); backdrop-filter: blur(20px); border: 1px solid rgba(255, 255, 255, 0.05); border-radius: 24px; padding: 1.5rem;">
                <h3 style="font-size: 0.75rem; font-weight: 800; color: #fff; text-transform: uppercase; letter-spacing: 0.1em; margin: 0 0 1.5rem 0;">Status Distribution</h3>
                <div style="display: flex; flex-direction: column; gap: 1rem;">
                    @php $totalStats = collect($byStatus)->sum(); @endphp
                    @foreach(['pending', 'approved', 'rejected', 'cancelled', 'completed'] as $s)
                        @php 
                            $count = $byStatus[$s] ?? 0;
                            $percent = $totalStats > 0 ? ($count / $totalStats) * 100 : 0;
                            $colors = [
                                'pending' => '#f59e0b',
                                'approved' => '#10b981',
                                'rejected' => '#f43f5e',
                                'cancelled' => '#64748b',
                                'completed' => '#3b82f6'
                            ];
                            $currentColor = $colors[$s] ?? '#fff';
                        @endphp
                        <div>
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.4rem;">
                                <span style="font-size: 10px; font-weight: 800; color: #94a3b8; text-transform: uppercase;">{{ $s }}</span>
                                <span style="font-size: 10px; font-weight: 800; color: {{ $currentColor }};">{{ $count }}</span>
                            </div>
                            <div style="height: 6px; width: 100%; background: rgba(255,255,255,0.05); border-radius: 10px; overflow: hidden;">
                                <div style="height: 100%; width: {{ $percent }}%; background: {{ $currentColor }}; box-shadow: 0 0 10px {{ $currentColor }}; border-radius: 10px;"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</div>

<style>
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endsection