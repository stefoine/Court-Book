@extends('layouts.app')

@section('title', 'Credential Recovery')
@section('header', 'Recovery Terminal')
@section('subheader', 'Initialize Access Key Restoration')

@section('content')
<div style="animation: fadeIn 0.8s ease-out; max-width: 28rem; margin: 4rem auto;">
    
    {{-- Recovery Card --}}
    <div style="background: rgba(30, 41, 59, 0.4); backdrop-filter: blur(25px); border: 1px solid rgba(255, 255, 255, 0.05); border-radius: 24px; padding: 2.5rem; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.6); position: relative; overflow: hidden;">
        
        {{-- Status Notification --}}
        @if(session('status'))
            <div style="background: rgba(16, 185, 129, 0.1); border: 1px solid rgba(16, 185, 129, 0.2); color: #10b981; padding: 1rem; border-radius: 12px; font-size: 0.8rem; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 10px;">
                <div style="width: 8px; height: 8px; border-radius: 50%; background: #10b981; box-shadow: 0 0 10px #10b981;"></div>
                {{ session('status') }}
            </div>
        @endif

        <p style="color: #94a3b8; font-size: 0.85rem; line-height: 1.5; margin-bottom: 2rem;">
            Enter your registered identity email. The system will dispatch a secure restoration link to your terminal.
        </p>

        <form method="POST" action="{{ route('password.email') }}" style="display: flex; flex-direction: column; gap: 1.5rem;">
            @csrf
            
            {{-- Email Input --}}
            <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                <label style="font-size: 10px; font-weight: 800; color: #475569; text-transform: uppercase; letter-spacing: 0.15em;">Registered Email</label>
                <input style="width: 100%; background: rgba(15, 23, 42, 0.6); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 12px; padding: 0.85rem 1rem; color: #fff; font-size: 0.95rem; outline: none; transition: 0.3s;" 
                       type="email" name="email" value="{{ old('email') }}" required placeholder="identity@nexus.sys"
                       onfocus="this.style.borderColor='#22d3ee'; this.style.boxShadow='0 0 15px rgba(34, 211, 238, 0.2)';"
                       onblur="this.style.borderColor='rgba(255, 255, 255, 0.1)';">
            </div>

            <button type="submit" 
                    style="background: linear-gradient(135deg, #22d3ee 0%, #0891b2 100%); color: #0f172a; border: none; padding: 1rem; border-radius: 12px; font-weight: 900; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.1em; cursor: pointer; transition: 0.3s; box-shadow: 0 4px 15px rgba(34, 211, 238, 0.2);"
                    onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 25px rgba(34, 211, 238, 0.4)';"
                    onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 15px rgba(34, 211, 238, 0.2)';"
                    onclick="this.innerText='DISPATCHING LINK...'">
                Request Recovery Link
            </button>

            <div style="text-align: center; margin-top: 0.5rem;">
                <a href="{{ route('login') }}" style="color: #475569; text-decoration: none; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.1em; transition: 0.2s;" onmouseover="this.style.color='#fff'">
                    Return to Login Terminal
                </a>
            </div>
        </form>
    </div>

    {{-- Technical Footer --}}
    <div style="margin-top: 2rem; text-align: center; font-family: 'JetBrains Mono', monospace; font-size: 9px; color: #1e293b; text-transform: uppercase; letter-spacing: 0.3em;">
        Protocol: SMTP_SECURE_RELAY
    </div>
</div>

<style>
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endsection