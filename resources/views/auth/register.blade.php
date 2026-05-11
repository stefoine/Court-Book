@extends('layouts.app')

@section('title', 'Register Identity')
@section('header', 'New Entity Registration')
@section('subheader', 'Initialize your profile within the Nexus System')

@section('content')
<div style="animation: fadeIn 0.8s ease-out; max-width: 28rem; margin: 2rem auto;">
    
    {{-- Registration Terminal Card --}}
    <div style="background: rgba(30, 41, 59, 0.4); backdrop-filter: blur(25px); border: 1px solid rgba(255, 255, 255, 0.05); border-radius: 24px; padding: 2.5rem; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.6); position: relative; overflow: hidden;">
        
        {{-- Scanning Line Animation Effect --}}
        <div style="position: absolute; top: 0; left: 0; right: 0; height: 1px; background: #22d3ee; opacity: 0.3; animation: scanLine 3s linear infinite;"></div>

        <form method="POST" action="{{ route('register') }}" style="display: flex; flex-direction: column; gap: 1.25rem;">
            @csrf
            
            {{-- Name Input --}}
            <div style="display: flex; flex-direction: column; gap: 0.4rem;">
                <label style="font-size: 10px; font-weight: 800; color: #475569; text-transform: uppercase; letter-spacing: 0.15em;">Full Identity Name</label>
                <input style="background: rgba(15, 23, 42, 0.6); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 12px; padding: 0.8rem 1rem; color: #fff; font-size: 0.9rem; outline: none; transition: 0.3s;" 
                       name="name" value="{{ old('name') }}" required autofocus placeholder="Ex. John Doe"
                       onfocus="this.style.borderColor='#22d3ee'; this.style.boxShadow='0 0 15px rgba(34, 211, 238, 0.2)';"
                       onblur="this.style.borderColor='rgba(255, 255, 255, 0.1)';">
            </div>

            {{-- Email Input --}}
            <div style="display: flex; flex-direction: column; gap: 0.4rem;">
                <label style="font-size: 10px; font-weight: 800; color: #475569; text-transform: uppercase; letter-spacing: 0.15em;">Communication Uplink (Email)</label>
                <input style="background: rgba(15, 23, 42, 0.6); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 12px; padding: 0.8rem 1rem; color: #fff; font-size: 0.9rem; outline: none; transition: 0.3s;" 
                       type="email" name="email" value="{{ old('email') }}" required placeholder="identity@nexus.sys"
                       onfocus="this.style.borderColor='#22d3ee'; this.style.boxShadow='0 0 15px rgba(34, 211, 238, 0.2)';"
                       onblur="this.style.borderColor='rgba(255, 255, 255, 0.1)';">
            </div>

            {{-- Password Input --}}
            <div style="display: flex; flex-direction: column; gap: 0.4rem;">
                <label style="font-size: 10px; font-weight: 800; color: #475569; text-transform: uppercase; letter-spacing: 0.15em;">Define Access Key</label>
                <input style="background: rgba(15, 23, 42, 0.6); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 12px; padding: 0.8rem 1rem; color: #fff; font-size: 0.9rem; outline: none; transition: 0.3s;" 
                       type="password" name="password" required placeholder="••••••••"
                       onfocus="this.style.borderColor='#22d3ee'; this.style.boxShadow='0 0 15px rgba(34, 211, 238, 0.2)';"
                       onblur="this.style.borderColor='rgba(255, 255, 255, 0.1)';">
            </div>

            {{-- Confirm Password Input --}}
            <div style="display: flex; flex-direction: column; gap: 0.4rem;">
                <label style="font-size: 10px; font-weight: 800; color: #475569; text-transform: uppercase; letter-spacing: 0.15em;">Confirm Access Key</label>
                <input style="background: rgba(15, 23, 42, 0.6); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 12px; padding: 0.8rem 1rem; color: #fff; font-size: 0.9rem; outline: none; transition: 0.3s;" 
                       type="password" name="password_confirmation" required placeholder="••••••••"
                       onfocus="this.style.borderColor='#22d3ee'; this.style.boxShadow='0 0 15px rgba(34, 211, 238, 0.2)';"
                       onblur="this.style.borderColor='rgba(255, 255, 255, 0.1)';">
            </div>

            <button type="submit" 
                    style="background: linear-gradient(135deg, #22d3ee 0%, #0891b2 100%); color: #0f172a; border: none; padding: 1rem; border-radius: 12px; font-weight: 900; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.1em; cursor: pointer; transition: 0.3s; margin-top: 1rem; box-shadow: 0 4px 15px rgba(34, 211, 238, 0.2);"
                    onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 25px rgba(34, 211, 238, 0.4)';"
                    onmouseout="this.style.transform='translateY(0)';">
                Authorize Registration
            </button>

            <div style="text-align: center; margin-top: 1rem; border-top: 1px solid rgba(255, 255, 255, 0.05); padding-top: 1.25rem;">
                <span style="color: #475569; font-size: 0.8rem;">Existing Entity?</span>
                <a href="{{ route('login') }}" style="color: #fff; text-decoration: none; font-size: 0.8rem; font-weight: 800; margin-left: 5px; border-bottom: 1px solid #22d3ee;">Access Terminal</a>
            </div>
        </form>
    </div>

    {{-- Meta Info --}}
    <div style="margin-top: 2rem; text-align: center; font-family: 'JetBrains Mono', monospace; font-size: 9px; color: #1e293b; text-transform: uppercase; letter-spacing: 0.2em;">
        ID_PROVISIONING_SYSTEM // v3.0.4
    </div>
</div>

<style>
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @keyframes scanLine {
        0% { top: 0; }
        100% { top: 100%; }
    }
</style>
@endsection