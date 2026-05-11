@extends('layouts.app')

@section('title', 'Sign In')
@section('header', 'Authentication Terminal')
@section('subheader', 'Identity Verification Required')

@section('content')
<div style="animation: fadeIn 0.8s ease-out; max-width: 28rem; margin: 2rem auto;">
    
    {{-- Login Card --}}
    <div style="background: rgba(30, 41, 59, 0.4); backdrop-filter: blur(25px); border: 1px solid rgba(255, 255, 255, 0.05); border-radius: 24px; padding: 2.5rem; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.6); position: relative; overflow: hidden;">
        
        {{-- Subtle Top Glow --}}
        <div style="position: absolute; top: 0; left: 0; right: 0; height: 2px; background: linear-gradient(90deg, transparent, #22d3ee, transparent); opacity: 0.5;"></div>

        <form method="POST" action="{{ route('login') }}" style="display: flex; flex-direction: column; gap: 1.5rem;">
            @csrf
            
            {{-- Email Input --}}
            <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                <label style="font-size: 10px; font-weight: 800; color: #475569; text-transform: uppercase; letter-spacing: 0.15em;">Identity (Email)</label>
                <input style="background: rgba(15, 23, 42, 0.6); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 12px; padding: 0.85rem 1rem; color: #fff; font-size: 0.95rem; outline: none; transition: 0.3s;" 
                       type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="name@domain.com"
                       onfocus="this.style.borderColor='#22d3ee'; this.style.boxShadow='0 0 15px rgba(34, 211, 238, 0.2)';"
                       onblur="this.style.borderColor='rgba(255, 255, 255, 0.1)'; this.style.boxShadow='none';">
            </div>

            {{-- Password Input --}}
            <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                <label style="font-size: 10px; font-weight: 800; color: #475569; text-transform: uppercase; letter-spacing: 0.15em;">Access Key</label>
                <input style="background: rgba(15, 23, 42, 0.6); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 12px; padding: 0.85rem 1rem; color: #fff; font-size: 0.95rem; outline: none; transition: 0.3s;" 
                       type="password" name="password" required placeholder="••••••••"
                       onfocus="this.style.borderColor='#22d3ee'; this.style.boxShadow='0 0 15px rgba(34, 211, 238, 0.2)';"
                       onblur="this.style.borderColor='rgba(255, 255, 255, 0.1)'; this.style.boxShadow='none';">
            </div>

            {{-- Remember Me & Action --}}
            <div style="display: flex; align-items: center; justify-content: space-between;">
                <label style="display: flex; align-items: center; gap: 8px; color: #94a3b8; font-size: 0.85rem; cursor: pointer;">
                    <input type="checkbox" name="remember" style="accent-color: #22d3ee; width: 1rem; height: 1rem;">
                    Persist Session
                </label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" style="color: #475569; text-decoration: none; font-size: 0.75rem; font-weight: 600; transition: 0.2s;" onmouseover="this.style.color='#22d3ee'" onmouseout="this.style.color='#475569'">Forgot Key?</a>
                @endif
            </div>

            <button type="submit" 
                    style="background: linear-gradient(135deg, #22d3ee 0%, #0891b2 100%); color: #0f172a; border: none; padding: 1rem; border-radius: 12px; font-weight: 900; font-size: 0.9rem; text-transform: uppercase; letter-spacing: 0.1em; cursor: pointer; transition: 0.3s; margin-top: 0.5rem; box-shadow: 0 0 20px rgba(34, 211, 238, 0.2);"
                    onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 0 30px rgba(34, 211, 238, 0.4)';"
                    onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 0 20px rgba(34, 211, 238, 0.2)';"
                    onclick="this.innerText='ESTABLISHING CONNECTION...'">
                Initialize Login
            </button>

            {{-- Footer Links --}}
            <div style="text-align: center; margin-top: 1rem; border-top: 1px solid rgba(255, 255, 255, 0.05); padding-top: 1.5rem;">
                <span style="color: #475569; font-size: 0.8rem;">New Entity?</span>
                <a href="{{ route('register') }}" style="color: #fff; text-decoration: none; font-size: 0.8rem; font-weight: 800; margin-left: 5px; border-bottom: 1px solid #22d3ee;">Register Identity</a>
            </div>
        </form>
    </div>

    {{-- System Status Footer --}}
    <div style="margin-top: 2rem; text-align: center; font-family: 'JetBrains Mono', monospace; font-size: 10px; color: #1e293b; letter-spacing: 0.2em;">
        SECURE_LINK_ACTIVE // SSL_ENCRYPTED
    </div>
</div>

<style>
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endsection