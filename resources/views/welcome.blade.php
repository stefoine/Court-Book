@extends('layouts.app')

@section('title', 'Welcome')
@section('header', 'Welcome')
@section('subheader', 'Reserve courts effortlessly')

@section('content')
<!-- BACKGROUND WRAPPER WITH CYBER-GLOW EFFECTS -->
<div style="position: relative; min-height: 100vh; background: #0f172a; overflow: hidden; font-family: 'Inter', sans-serif; padding: 2rem 1rem;">
    <!-- AMBIENT GLOW DECORATIONS -->
    <div style="position: absolute; top: -10%; left: -10%; width: 500px; height: 500px; background: radial-gradient(circle, rgba(6, 182, 212, 0.15) 0%, transparent 70%); border-radius: 50%; pointer-events: none;"></div>
    <div style="position: absolute; bottom: -10%; right: -10%; width: 600px; height: 600px; background: radial-gradient(circle, rgba(59, 130, 246, 0.1) 0%, transparent 70%); border-radius: 50%; pointer-events: none;"></div>

    <div style="position: relative; max-width: 1200px; margin: 0 auto; display: grid; gap: 2.5rem; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); align-items: start;">
        
        <!-- HERO / MAIN CONTENT SECTION -->
        <section style="display: flex; flex-direction: column; justify-content: center; animation: slideUp 0.8s ease-out; opacity: 0; animation-fill-mode: forwards;">
            <div style="margin-bottom: 1.5rem; display: inline-flex; align-items: center; gap: 0.75rem; background: rgba(255, 255, 255, 0.05); padding: 0.5rem 1rem; border-radius: 99px; border: 1px solid rgba(255, 255, 255, 0.1); width: fit-content;">
                <span style="width: 8px; height: 8px; background: #06b6d4; border-radius: 50%; box-shadow: 0 0 10px #06b6d4;"></span>
                <span style="font-size: 0.75rem; font-weight: 700; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.1em;">Smart Management System</span>
            </div>

            <h2 style="font-size: clamp(2.5rem, 5vw, 4rem); font-weight: 900; color: #f8fafc; line-height: 1.1; margin-bottom: 1.5rem; letter-spacing: -0.02em;">
                Multi-Purpose <br/>
                <span style="background: linear-gradient(90deg, #3b82f6, #06b6d4); -webkit-background-clip: text; -webkit-text-fill-color: transparent; text-shadow: 0 0 30px rgba(59, 130, 246, 0.3);">Court Booking</span>
            </h2>

            <p style="font-size: 1.125rem; color: #94a3b8; line-height: 1.6; max-width: 500px; margin-bottom: 2.5rem;">
                Book basketball, volleyball, badminton, futsal courts, and event halls — <span style="color: #cbd5e1; font-weight: 500;">fast, transparent, and conflict-free.</span>
            </p>

            <!-- CALL TO ACTION BUTTONS -->
            <div style="display: flex; flex-wrap: wrap; gap: 1.25rem;">
                @auth
                    <a href="{{ route('dashboard') }}" 
                       style="padding: 1rem 2.5rem; background: linear-gradient(135deg, #3b82f6, #2563eb); color: white; text-decoration: none; font-weight: 600; border-radius: 12px; box-shadow: 0 10px 20px -5px rgba(37, 99, 235, 0.4); transition: all 0.3s; transform: translateY(0);"
                       onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 15px 25px -5px rgba(37, 99, 235, 0.5)';"
                       onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 10px 20px -5px rgba(37, 99, 235, 0.4)';"
                    >
                        Open Dashboard
                    </a>
                @else
                    <a href="{{ route('register') }}" 
                       style="padding: 1rem 2.5rem; background: #f8fafc; color: #0f172a; text-decoration: none; font-weight: 600; border-radius: 12px; box-shadow: 0 10px 20px -5px rgba(0, 0, 0, 0.2); transition: all 0.3s; transform: translateY(0);"
                       onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 15px 25px -5px rgba(0, 0, 0, 0.3)';"
                       onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 10px 20px -5px rgba(0, 0, 0, 0.2)';"
                    >
                        Get Started
                    </a>
                    <a href="{{ route('login') }}" 
                       style="padding: 1rem 2rem; background: rgba(255, 255, 255, 0.05); color: #f8fafc; text-decoration: none; font-weight: 600; border-radius: 12px; border: 1px solid rgba(255, 255, 255, 0.1); backdrop-filter: blur(10px); transition: all 0.3s;"
                       onmouseover="this.style.background='rgba(255, 255, 255, 0.1)'; this.style.borderColor='rgba(255, 255, 255, 0.2)';"
                       onmouseout="this.style.background='rgba(255, 255, 255, 0.05)'; this.style.borderColor='rgba(255, 255, 255, 0.1)';"
                    >
                        Sign in
                    </a>
                @endauth

                <a href="{{ route('courts.index') }}" 
                   style="padding: 1rem 2rem; background: transparent; color: #94a3b8; text-decoration: none; font-weight: 500; border-radius: 12px; border: 1px dashed rgba(148, 163, 184, 0.3); transition: all 0.3s;"
                   onmouseover="this.style.color='#f8fafc'; this.style.borderColor='#f8fafc';"
                   onmouseout="this.style.color='#94a3b8'; this.style.borderColor='rgba(148, 163, 184, 0.3)';"
                >
                    Browse Courts
                </a>
            </div>
        </section>

        <!-- UPDATES / ANNOUNCEMENTS CARD -->
        <aside style="background: rgba(30, 41, 59, 0.5); backdrop-filter: blur(20px); border: 1px solid rgba(255, 255, 255, 0.05); border-radius: 24px; padding: 2rem; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5); animation: slideUp 0.8s ease-out 0.2s; opacity: 0; animation-fill-mode: forwards;">
            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 2rem;">
                <h3 style="font-size: 1.25rem; font-weight: 700; color: #f8fafc; display: flex; align-items: center; gap: 0.75rem;">
                    Latest Updates
                </h3>
                <div style="position: relative; display: flex; align-items: center; justify-content: center;">
                    <span style="position: absolute; width: 12px; height: 12px; background: rgba(6, 182, 212, 0.4); border-radius: 50%; animation: pulse 2s infinite;"></span>
                    <span style="width: 6px; height: 6px; background: #06b6d4; border-radius: 50%;"></span>
                </div>
            </div>

            <div style="display: flex; flex-direction: column; gap: 1rem;">
                @forelse($globalAnnouncements ?? [] as $a)
                    <div style="padding: 1.25rem; background: rgba(255, 255, 255, 0.03); border: 1px solid rgba(255, 255, 255, 0.05); border-radius: 16px; transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1); cursor: pointer; transform: scale(1);"
                         onmouseover="this.style.background='rgba(255, 255, 255, 0.08)'; this.style.borderColor='rgba(6, 182, 212, 0.3)'; this.style.transform='scale(1.02)';"
                         onmouseout="this.style.background='rgba(255, 255, 255, 0.03)'; this.style.borderColor='rgba(255, 255, 255, 0.05)'; this.style.transform='scale(1)';"
                    >
                        <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 0.5rem;">
                            <p style="font-weight: 600; color: #f1f5f9; font-size: 0.95rem; margin: 0;">{{ $a->title }}</p>
                            <span style="font-size: 0.65rem; font-weight: 800; background: #06b6d4; color: #0f172a; padding: 2px 8px; border-radius: 4px; text-transform: uppercase;">New</span>
                        </div>
                        <div style="display: flex; align-items: center; gap: 0.5rem; color: #64748b; font-size: 0.75rem;">
                            <svg style="width: 12px; height: 12px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            {{ $a->created_at->diffForHumans() }}
                        </div>
                    </div>
                @empty
                    <div style="text-align: center; padding: 3rem 0; border: 1px dashed rgba(148, 163, 184, 0.1); border-radius: 16px;">
                        <div style="color: #475569; font-style: italic; margin-bottom: 0.5rem;">No active announcements</div>
                        <p style="font-size: 0.65rem; color: #334155; text-transform: uppercase; letter-spacing: 0.2em; margin: 0;">System standby</p>
                    </div>
                @endforelse
            </div>
        </aside>
    </div>
</div>

<!-- INLINE KEYFRAME EMULATIONS (via standard CSS if available, otherwise handled by browsers that support standard animation properties) -->
<style>
    @keyframes slideUp {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @keyframes pulse {
        0% { transform: scale(1); opacity: 0.8; }
        70% { transform: scale(3); opacity: 0; }
        100% { transform: scale(3); opacity: 0; }
    }
</style>
@endsection
