@extends('layouts.app')

@section('title', 'Key Re-encryption')
@section('header', 'Security Override')
@section('subheader', 'Establishing New Access Credentials')

@section('content')
<div style="animation: fadeIn 0.8s ease-out; max-width: 28rem; margin: 4rem auto;">
    
    {{-- Reset Terminal Card --}}
    <div style="background: rgba(30, 41, 59, 0.4); backdrop-filter: blur(25px); border: 1px solid rgba(255, 255, 255, 0.05); border-radius: 24px; padding: 2.5rem; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.6); position: relative;">
        
        {{-- Progress Line --}}
        <div style="position: absolute; top: 0; left: 0; right: 0; height: 2px; background: linear-gradient(90deg, transparent, #f59e0b, transparent); opacity: 0.5;"></div>

        <form method="POST" action="{{ route('password.store') }}" style="display: flex; flex-direction: column; gap: 1.5rem;">
            @csrf
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            {{-- Email Identity (Read-only feel) --}}
            <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                <label style="font-size: 10px; font-weight: 800; color: #475569; text-transform: uppercase; letter-spacing: 0.15em;">Identity Verified</label>
                <input style="width: 100%; background: rgba(15, 23, 42, 0.4); border: 1px solid rgba(255, 255, 255, 0.05); border-radius: 12px; padding: 0.85rem 1rem; color: #94a3b8; font-size: 0.9rem; cursor: not-allowed;" 
                       type="email" name="email" value="{{ old('email', $request->email) }}" required readonly>
            </div>

            {{-- New Password --}}
            <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                <label style="font-size: 10px; font-weight: 800; color: #475569; text-transform: uppercase; letter-spacing: 0.15em;">New Access Key</label>
                <input style="width: 100%; background: rgba(15, 23, 42, 0.6); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 12px; padding: 0.85rem 1rem; color: #fff; font-size: 0.95rem; outline: none; transition: 0.3s;" 
                       type="password" name="password" required placeholder="••••••••"
                       onfocus="this.style.borderColor='#f59e0b'; this.style.boxShadow='0 0 15px rgba(245, 158, 11, 0.2)';"
                       onblur="this.style.borderColor='rgba(255, 255, 255, 0.1)';" />
            </div>

            {{-- Confirm Password --}}
            <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                <label style="font-size: 10px; font-weight: 800; color: #475569; text-transform: uppercase; letter-spacing: 0.15em;">Validate Key</label>
                <input style="width: 100%; background: rgba(15, 23, 42, 0.6); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 12px; padding: 0.85rem 1rem; color: #fff; font-size: 0.95rem; outline: none; transition: 0.3s;" 
                       type="password" name="password_confirmation" required placeholder="••••••••"
                       onfocus="this.style.borderColor='#f59e0b'; this.style.boxShadow='0 0 15px rgba(245, 158, 11, 0.2)';"
                       onblur="this.style.borderColor='rgba(255, 255, 255, 0.1)';" />
            </div>

            <button type="submit" 
                    style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); color: #0f172a; border: none; padding: 1rem; border-radius: 12px; font-weight: 900; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.1em; cursor: pointer; transition: 0.3s; box-shadow: 0 4px 15px rgba(245, 158, 11, 0.2); margin-top: 1rem;"
                    onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 25px rgba(245, 158, 11, 0.4)';"
                    onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 15px rgba(245, 158, 11, 0.2)';"
                    onclick="this.innerText='RE-ENCRYPTING...'">
                Finalize Key Reset
            </button>
        </form>
    </div>

    {{-- System Status --}}
    <div style="margin-top: 2rem; text-align: center; font-family: 'JetBrains Mono', monospace; font-size: 9px; color: #1e293b; text-transform: uppercase; letter-spacing: 0.3em;">
        Security_Level: HIGH // Protocol: RSA_4096
    </div>
</div>

<style>
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endsection