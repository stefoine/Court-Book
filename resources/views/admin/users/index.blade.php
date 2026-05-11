@extends('layouts.app')

@section('title', 'System Identities')
@section('header', 'Identity Management')
@section('subheader', 'Access Control & Security Protocol')

@section('content')
<div style="animation: fadeIn 0.8s ease-out;">

    {{-- Search Terminal --}}
    <div style="background: rgba(30, 41, 59, 0.4); backdrop-filter: blur(20px); border: 1px solid rgba(255, 255, 255, 0.05); border-radius: 20px; padding: 1.25rem; margin-bottom: 1.5rem;">
        <form method="GET" style="display: flex; gap: 1rem; align-items: center;">
            <div style="position: relative; flex: 1; max-width: 400px;">
                <input style="width: 100%; background: rgba(15, 23, 42, 0.6); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 10px; padding: 0.65rem 1rem; color: #fff; font-size: 0.85rem; outline: none; transition: 0.3s;" 
                       name="search" value="{{ request('search') }}" placeholder="Scan for Name or Email identity..."
                       onfocus="this.style.borderColor='#22d3ee'; this.style.boxShadow='0 0 10px rgba(34, 211, 238, 0.2)';"
                       onblur="this.style.borderColor='rgba(255, 255, 255, 0.1)';" />
            </div>
            <button style="background: rgba(34, 211, 238, 0.1); color: #22d3ee; border: 1px solid rgba(34, 211, 238, 0.2); padding: 0.65rem 1.5rem; border-radius: 10px; font-weight: 800; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.1em; cursor: pointer; transition: 0.3s;"
                    onmouseover="this.style.background='rgba(34, 211, 238, 0.2)';">
                Execute Scan
            </button>
        </form>
    </div>

    {{-- Identity Registry Table --}}
    <div style="background: rgba(30, 41, 59, 0.3); backdrop-filter: blur(20px); border: 1px solid rgba(255, 255, 255, 0.05); border-radius: 24px; overflow: hidden; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);">
        <div style="overflow-x: auto; padding: 1rem;">
            <table style="width: 100%; border-collapse: separate; border-spacing: 0 8px;">
                <thead>
                    <tr style="text-align: left;">
                        <th style="padding: 1rem; font-size: 10px; color: #475569; text-transform: uppercase; letter-spacing: 0.2em; font-weight: 800;">Subject Identity</th>
                        <th style="padding: 1rem; font-size: 10px; color: #475569; text-transform: uppercase; letter-spacing: 0.2em; font-weight: 800;">Access Level</th>
                        <th style="padding: 1rem; font-size: 10px; color: #475569; text-transform: uppercase; letter-spacing: 0.2em; font-weight: 800;">Status</th>
                        <th style="padding: 1rem; font-size: 10px; color: #475569; text-transform: uppercase; letter-spacing: 0.2em; font-weight: 800;">Log Count</th>
                        <th style="padding: 1rem; font-size: 10px; color: #475569; text-transform: uppercase; letter-spacing: 0.2em; font-weight: 800; text-align: right;">Security Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($users as $u)
                    <tr style="background: rgba(255, 255, 255, 0.02); transition: 0.3s;" 
                        onmouseover="this.style.background='rgba(255, 255, 255, 0.05)';" 
                        onmouseout="this.style.background='rgba(255, 255, 255, 0.02)';">
                        
                        <td style="padding: 1.25rem 1rem; border-radius: 16px 0 0 16px;">
                            <div style="color: #fff; font-weight: 700; font-size: 0.9rem; margin-bottom: 2px;">{{ $u->name }}</div>
                            <div style="color: #475569; font-size: 0.75rem; font-family: 'JetBrains Mono', monospace;">{{ $u->email }}</div>
                        </td>
                        
                        <td style="padding: 1.25rem 1rem;">
                            <form method="POST" action="{{ route('admin.users.changeRole',$u) }}" style="display: flex; gap: 8px; align-items: center;">
                                @csrf
                                <select name="role" style="background: rgba(15, 23, 42, 0.6); border: 1px solid rgba(255,255,255,0.1); border-radius: 6px; padding: 4px 8px; color: #cbd5e1; font-size: 0.75rem; outline: none; cursor: pointer;">
                                    <option value="user" @selected($u->role==='user') style="background: #0f172a;">User</option>
                                    <option value="admin" @selected($u->role==='admin') style="background: #0f172a;">Admin</option>
                                </select>
                                <button style="background: transparent; border: none; color: #22d3ee; font-size: 10px; font-weight: 800; text-transform: uppercase; cursor: pointer; border-bottom: 1px solid transparent; transition: 0.2s;" onmouseover="this.style.borderColor='#22d3ee'">Save</button>
                            </form>
                        </td>
                        
                        <td style="padding: 1.25rem 1rem;">
                            <span style="padding: 4px 12px; border-radius: 20px; font-size: 9px; font-weight: 800; text-transform: uppercase; border: 1px solid currentColor;
                                @if($u->is_banned) color: #f43f5e; background: rgba(244, 63, 94, 0.1); @else color: #10b981; background: rgba(16, 185, 129, 0.1); @endif">
                                {{ $u->is_banned ? 'Banned' : 'Active' }}
                            </span>
                        </td>

                        <td style="padding: 1.25rem 1rem;">
                            <div style="color: #cbd5e1; font-size: 0.85rem; font-weight: 600;">{{ $u->bookings()->count() }} <small style="color: #475569; font-weight: 400;">Entries</small></div>
                        </td>
                        
                        <td style="padding: 1.25rem 1rem; text-align: right; border-radius: 0 16px 16px 0;">
                            <form method="POST" action="{{ route('admin.users.toggleBan',$u) }}">
                                @csrf
                                <button onclick="return confirm('Override security status for {{ $u->name }}?')" 
                                        style="background: {{ $u->is_banned ? 'rgba(16, 185, 129, 0.1)' : 'rgba(244, 63, 94, 0.1)' }}; 
                                               color: {{ $u->is_banned ? '#10b981' : '#f43f5e' }}; 
                                               border: 1px solid currentColor; 
                                               padding: 6px 16px; border-radius: 8px; font-size: 10px; font-weight: 800; text-transform: uppercase; cursor: pointer; transition: 0.3s;"
                                        onmouseover="this.style.opacity='0.8'; this.style.transform='translateY(-1px)';"
                                        onmouseout="this.style.opacity='1'; this.style.transform='translateY(0)';">
                                    {{ $u->is_banned ? 'Authorize (Unban)' : 'Revoke (Ban)' }}
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Pagination Registry --}}
    <div style="margin-top: 1.5rem; display: flex; justify-content: center; opacity: 0.7;">
        {{ $users->links() }}
    </div>
</div>

<style>
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endsection