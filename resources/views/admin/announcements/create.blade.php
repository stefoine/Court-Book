@extends('layouts.app')
@section('title','New Announcement') @section('header','New Announcement')
@section('content')
<div style="animation: slideUp 0.6s ease-out; opacity: 0; animation-fill-mode: forwards; max-width: 42rem; margin: 2rem auto; position: relative;">
    <style>
        @keyframes slideUp { from { opacity: 0; transform: translateY(30px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes neonPulse { 0% { box-shadow: 0 0 5px rgba(34, 211, 238, 0.2); } 50% { box-shadow: 0 0 20px rgba(34, 211, 238, 0.4); } 100% { box-shadow: 0 0 5px rgba(34, 211, 238, 0.2); } }
    </style>
    
    <div style="background: rgba(15, 23, 42, 0.8); backdrop-filter: blur(12px); border: 1px solid rgba(34, 211, 238, 0.3); border-radius: 20px; padding: 2.5rem; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5); transition: 0.3s;"
         onmouseover="this.style.borderColor='rgba(34, 211, 238, 0.8)'" onmouseout="this.style.borderColor='rgba(34, 211, 238, 0.3)'">
        
        <h3 style="color: #22d3ee; font-weight: 800; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 1.5rem; font-size: 0.9rem; display: flex; align-items: center; gap: 10px;">
            <span style="width: 8px; height: 8px; background: #22d3ee; border-radius: 50%; box-shadow: 0 0 10px #22d3ee;"></span>
            Initialize Announcement
        </h3>

        <form method="POST" action="{{ route('admin.announcements.store') }}" style="display: flex; flex-direction: column; gap: 1.5rem;">
            @csrf
            <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                <label style="color: #94a3b8; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1px;">Project Subject</label>
                <input name="title" value="{{ old('title') }}" required 
                       style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.1); border-radius: 10px; padding: 0.8rem; color: white; outline: none; transition: 0.3s;"
                       onfocus="this.style.border='1px solid #22d3ee'; this.style.background='rgba(34, 211, 238, 0.05)'"
                       onblur="this.style.border='1px solid rgba(255,255,255,0.1)'; this.style.background='rgba(255,255,255,0.03)'">
            </div>

            <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                <label style="color: #94a3b8; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1px;">Data Content</label>
                <textarea name="body" rows="6" required
                          style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.1); border-radius: 10px; padding: 0.8rem; color: white; outline: none; transition: 0.3s; resize: none;"
                          onfocus="this.style.border='1px solid #22d3ee'; this.style.background='rgba(34, 211, 238, 0.05)'"
                          onblur="this.style.border='1px solid rgba(255,255,255,0.1)'; this.style.background='rgba(255,255,255,0.03)'">{{ old('body') }}</textarea>
            </div>

            <label style="display: flex; align-items: center; gap: 10px; cursor: pointer; color: #cbd5e1; font-size: 0.85rem; user-select: none;">
                <input type="checkbox" name="is_published" value="1" checked style="accent-color: #22d3ee; width: 1.1rem; height: 1.1rem;">
                Transmit to public frequency immediately
            </label>

            <button style="background: linear-gradient(90deg, #0891b2 0%, #22d3ee 100%); color: #000; font-weight: 800; text-transform: uppercase; letter-spacing: 2px; padding: 1rem; border: none; border-radius: 12px; cursor: pointer; transition: 0.4s; box-shadow: 0 4px 15px rgba(34, 211, 238, 0.3);"
                    onmouseover="this.style.transform='scale(1.02)'; this.style.boxShadow='0 0 25px rgba(34, 211, 238, 0.6)'"
                    onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='0 4px 15px rgba(34, 211, 238, 0.3)'">
                Broadcast Post
            </button>
        </form>
    </div>
</div>
@endsection