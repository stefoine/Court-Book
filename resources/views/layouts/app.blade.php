<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Court Booking') · {{ config('app.name') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body style="margin: 0; padding: 0; background-color: #0f172a; min-height: 100vh; font-family: 'Figtree', sans-serif;">

<div style="display: flex; min-height: 100vh; background: radial-gradient(circle at top right, #1e293b, #0f172a);" x-data="{ open: false }">

    {{-- SIDEBAR --}}
    <aside style="display: flex; width: 18rem; flex-direction: column; border-right: 1px solid rgba(255, 255, 255, 0.05); background: rgba(15, 23, 42, 0.9); backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px); padding: 1.5rem; position: sticky; top: 0; height: 100vh; z-index: 50;">
        
        {{-- Branding --}}
        <a href="{{ route('home') }}" style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 3rem; text-decoration: none;">
            <div style="width: 2.75rem; height: 2.75rem; border-radius: 0.75rem; background: linear-gradient(135deg, #22d3ee 0%, #0891b2 100%); display: grid; place-items: center; color: #0f172a; font-weight: 900; font-size: 1.25rem; box-shadow: 0 0 15px rgba(34, 211, 238, 0.4);">
                C
            </div>
            <div style="display: flex; flex-direction: column;">
                <span style="font-weight: 800; font-size: 1.25rem; color: #fff; letter-spacing: -0.025em; line-height: 1.2;">CourtBook</span>
                <span style="font-size: 10px; color: #22d3ee; font-weight: 700; text-transform: uppercase; letter-spacing: 0.2em; opacity: 0.8;"></span>
            </div>
        </a>

        {{-- Navigation Links --}}
        <nav style="flex: 1; display: flex; flex-direction: column; gap: 0.5rem;">
            <div style="padding: 0 0.75rem; margin-bottom: 0.5rem; font-size: 10px; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: 0.25em;">
                System Control
            </div>
            
            @auth
                @php
                    $isAdmin = auth()->user()->isAdmin();
                    $baseStyle = "display: flex; align-items: center; gap: 12px; padding: 0.85rem 1rem; border-radius: 12px; text-decoration: none; font-size: 0.875rem; font-weight: 600; transition: all 0.3s ease;";
                    $activeStyle = "background: linear-gradient(90deg, rgba(34, 211, 238, 0.1) 0%, rgba(34, 211, 238, 0) 100%); color: #22d3ee; border-left: 3px solid #22d3ee; box-shadow: inset 8px 0 15px -10px rgba(34, 211, 238, 0.3);";
                    $inactiveStyle = "color: #94a3b8;";
                @endphp

                @if($isAdmin)
                    <a href="{{ route('admin.dashboard') }}" style="{{ $baseStyle }} {{ request()->routeIs('admin.dashboard') ? $activeStyle : $inactiveStyle }}">
                        <span>📊</span> Admin Dashboard
                    </a>
                    <a href="{{ route('admin.courts.index') }}" style="{{ $baseStyle }} {{ request()->routeIs('admin.courts.*') ? $activeStyle : $inactiveStyle }}">
                        <span>🏟</span> Arena Registry
                    </a>
                    <a href="{{ route('admin.bookings.index') }}" style="{{ $baseStyle }} {{ request()->routeIs('admin.bookings.*') ? $activeStyle : $inactiveStyle }}">
                        <span>📅</span> Operations Log
                    </a>
                    <a href="{{ route('admin.users.index') }}" style="{{ $baseStyle }} {{ request()->routeIs('admin.users.*') ? $activeStyle : $inactiveStyle }}">
                        <span>👥</span> Entity Database
                    </a>
                    <a href="{{ route('admin.announcements.index') }}" style="{{ $baseStyle }} {{ request()->routeIs('admin.announcements.*') ? $activeStyle : $inactiveStyle }}">
                        <span>📢</span> Broadcasts
                    </a>
                @else
                    <a href="{{ route('dashboard') }}" style="{{ $baseStyle }} {{ request()->routeIs('dashboard') ? $activeStyle : $inactiveStyle }}">
                        <span>🏠</span> Terminal Home
                    </a>
                    <a href="{{ route('courts.index') }}" style="{{ $baseStyle }} {{ request()->routeIs('courts.*') ? $activeStyle : $inactiveStyle }}">
                        <span>🏟</span> Browse Arenas
                    </a>
                    <a href="{{ route('bookings.index') }}" style="{{ $baseStyle }} {{ request()->routeIs('bookings.index') ? $activeStyle : $inactiveStyle }}">
                        <span>📅</span> My Schedule
                    </a>
                    <a href="{{ route('announcements.index') }}" style="{{ $baseStyle }} {{ request()->routeIs('announcements.*') ? $activeStyle : $inactiveStyle }}">
                        <span>📢</span> Bulletins
                    </a>
                @endif
            @endauth
        </nav>

        {{-- Logout/Login --}}
        <div style="margin-top: auto; padding-top: 1.5rem; border-top: 1px solid rgba(255, 255, 255, 0.05);">
            @auth
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" style="width: 100%; display: flex; align-items: center; justify-content: center; gap: 8px; padding: 0.75rem; border-radius: 12px; border: 1px solid rgba(244, 63, 94, 0.2); background: rgba(244, 63, 94, 0.05); color: #f43f5e; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; cursor: pointer; transition: 0.3s;" onmouseover="this.style.background='rgba(244, 63, 94, 0.2)'; this.style.color='#fff';" onmouseout="this.style.background='rgba(244, 63, 94, 0.05)'; this.style.color='#f43f5e';">
                        Terminate Session
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" style="width: 100%; display: flex; align-items: center; justify-content: center; padding: 0.75rem; border-radius: 12px; background: #22d3ee; color: #0f172a; font-size: 0.75rem; font-weight: 800; text-transform: uppercase; text-decoration: none;">
                    Login Terminal
                </a>
            @endauth
        </div>
    </aside>

    {{-- MAIN WRAPPER --}}
    <div style="flex: 1; display: flex; flex-direction: column; overflow: hidden;">
        
        {{-- Top Bar --}}
        <header style="display: flex; align-items: center; justify-content: space-between; padding: 1.25rem 2rem; border-bottom: 1px solid rgba(255, 255, 255, 0.05); background: rgba(15, 23, 42, 0.2); backdrop-filter: blur(10px);">
            <div>
                <h1 style="font-size: 1.125rem; font-weight: 700; color: #fff; margin: 0;">@yield('header', 'System Terminal')</h1>
                <p style="font-size: 0.7rem; color: #475569; margin: 0; text-transform: uppercase; letter-spacing: 0.1em;">@yield('subheader', 'Multi-Purpose Court Booking')</p>
            </div>
            
            <div style="display: flex; align-items: center; gap: 1rem;">
                @auth
                    <div style="text-align: right;">
                        <div style="font-size: 0.7rem; color: #475569; text-transform: uppercase;">Operator</div>
                        <div style="font-size: 0.875rem; font-weight: 700; color: #fff;">{{ auth()->user()->name }}</div>
                    </div>
                    <span style="background: {{ auth()->user()->isAdmin() ? 'rgba(34, 211, 238, 0.1)' : 'rgba(16, 185, 129, 0.1)' }}; color: {{ auth()->user()->isAdmin() ? '#22d3ee' : '#10b981' }}; padding: 4px 12px; border-radius: 8px; font-size: 0.65rem; font-weight: 800; border: 1px solid currentColor; text-transform: uppercase;">
                        {{ auth()->user()->role }}
                    </span>
                @endauth
            </div>
        </header>

        {{-- Flash Messages --}}
        @if(session('success'))
            <div style="margin: 1.5rem 2rem 0; padding: 1rem; border-radius: 12px; background: rgba(16, 185, 129, 0.1); border: 1px solid rgba(16, 185, 129, 0.2); color: #10b981; font-size: 0.85rem;">
                {{ session('success') }}
            </div>
        @endif

        {{-- Main Content --}}
        <main style="flex: 1; padding: 2rem; overflow-y: auto;">
            @yield('content')
        </main>

        {{-- Footer --}}
        <footer style="padding: 1.5rem; text-align: center; font-size: 0.7rem; color: #334155; border-top: 1px solid rgba(255, 255, 255, 0.05);">
            &copy; {{ date('Y') }} {{ config('app.name') }} // <span style="color: #22d3ee;">STATUS: OPERATIONAL</span>
        </footer>
    </div>
</div>

</body>
</html>