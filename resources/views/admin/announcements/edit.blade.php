@extends('layouts.app')

@section('title', 'Edit Announcement')
@section('header', 'Edit Announcement')

@section('content')
<!-- Futuristic Edit Form Container -->
<div style="min-height: 100vh; padding: 1.5rem; font-family: 'Inter', system-ui, -apple-system, sans-serif; background: radial-gradient(circle at top right, #1e293b, #0f172a); color: #f8fafc; display: flex; align-items: center; justify-content: center; animation: fadeIn 0.8s ease-out;">

    <!-- Form Card: Glassmorphism Design -->
    <div style="width: 100%; max-width: 600px; background: rgba(30, 41, 59, 0.4); backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px); border: 1px solid rgba(251, 191, 36, 0.2); border-radius: 24px; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5); overflow: hidden; animation: slideUp 0.6s cubic-bezier(0.16, 1, 0.3, 1);">
        
        <!-- Card Header -->
        <div style="padding: 2rem; border-bottom: 1px solid rgba(255, 255, 255, 0.05); background: rgba(0,0,0,0.1);">
            <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 0.5rem;">
                <div style="width: 8px; height: 24px; background: #fbbf24; border-radius: 4px; box-shadow: 0 0 15px rgba(251, 191, 36, 0.5);"></div>
                <h3 style="color: #fbbf24; font-weight: 800; font-size: 1.5rem; margin: 0; letter-spacing: -0.025em; text-transform: uppercase;">Modify Record</h3>
            </div>
            <p style="color: #94a3b8; font-size: 0.85rem; margin: 0; font-family: 'JetBrains Mono', monospace; opacity: 0.8;">IDENTIFIER: #{{ $announcement->id }}</p>
        </div>

        <!-- Form Section -->
        <div style="padding: 2.5rem;">
            <form method="POST" action="{{ route('admin.announcements.update',$announcement) }}" style="display: flex; flex-direction: column; gap: 2rem;">
                @csrf @method('PUT')

                <!-- Title Input Group -->
                <div style="display: flex; flex-direction: column; gap: 0.75rem;">
                    <label style="color: #64748b; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.1em; display: flex; align-items: center; gap: 8px;">
                        <span style="color: #fbbf24;">//</span> Update Subject
                    </label>
                    <input name="title" value="{{ old('title',$announcement->title) }}" required 
                           style="background: rgba(15, 23, 42, 0.6); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 12px; padding: 1rem; color: #fff; font-size: 1rem; outline: none; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); box-shadow: inset 0 2px 4px rgba(0,0,0,0.1);"
                           onfocus="this.style.borderColor='#fbbf24'; this.style.background='rgba(15, 23, 42, 0.8)'; this.style.boxShadow='0 0 15px rgba(251, 191, 36, 0.15), inset 0 2px 4px rgba(0,0,0,0.2)';"
                           onblur="this.style.borderColor='rgba(255, 255, 255, 0.1)'; this.style.background='rgba(15, 23, 42, 0.6)'; this.style.boxShadow='inset 0 2px 4px rgba(0,0,0,0.1)';"
                    >
                </div>

                <!-- Body Textarea Group -->
                <div style="display: flex; flex-direction: column; gap: 0.75rem;">
                    <label style="color: #64748b; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.1em; display: flex; align-items: center; gap: 8px;">
                        <span style="color: #fbbf24;">//</span> Edit Transmission Content
                    </label>
                    <textarea name="body" rows="6" required
                              style="background: rgba(15, 23, 42, 0.6); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 12px; padding: 1rem; color: #fff; font-size: 1rem; outline: none; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); resize: none; line-height: 1.6; box-shadow: inset 0 2px 4px rgba(0,0,0,0.1);"
                              onfocus="this.style.borderColor='#fbbf24'; this.style.background='rgba(15, 23, 42, 0.8)'; this.style.boxShadow='0 0 15px rgba(251, 191, 36, 0.15), inset 0 2px 4px rgba(0,0,0,0.2)';"
                              onblur="this.style.borderColor='rgba(255, 255, 255, 0.1)'; this.style.background='rgba(15, 23, 42, 0.6)'; this.style.boxShadow='inset 0 2px 4px rgba(0,0,0,0.1)';"
                    >{{ old('body',$announcement->body) }}</textarea>
                </div>

                <!-- Status Checkbox -->
                <label style="display: flex; align-items: center; gap: 15px; cursor: pointer; color: #cbd5e1; font-size: 0.9rem; background: rgba(255,255,255,0.03); padding: 1rem; border-radius: 12px; border: 1px solid rgba(255,255,255,0.05); transition: 0.3s;"
                       onmouseover="this.style.background='rgba(255,255,255,0.07)'; this.style.borderColor='rgba(251,191,36,0.2)';"
                       onmouseout="this.style.background='rgba(255,255,255,0.03)'; this.style.borderColor='rgba(255,255,255,0.05)';"
                >
                    <div style="position: relative; display: flex; align-items: center; justify-content: center;">
                        <input type="checkbox" name="is_published" value="1" @checked($announcement->is_published) 
                               style="accent-color: #fbbf24; width: 1.25rem; height: 1.25rem; cursor: pointer;">
                    </div>
                    <span style="font-weight: 500;">Active Transmission Status</span>
                </label>

                <!-- Submit Action -->
                <button type="submit"
                        style="background: linear-gradient(135deg, #fbbf24 0%, #d97706 100%); color: #000; padding: 1.25rem; border-radius: 14px; border: none; font-weight: 800; font-size: 1rem; text-transform: uppercase; letter-spacing: 1px; cursor: pointer; transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275); margin-top: 1rem; box-shadow: 0 4px 15px rgba(251, 191, 36, 0.2);"
                        onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 10px 25px rgba(251, 191, 36, 0.4)'; this.style.filter='brightness(1.1)';"
                        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 15px rgba(251, 191, 36, 0.2)'; this.style.filter='brightness(1)';"
                >
                    Execute Update Protocol
                </button>
            </form>
        </div>

        <!-- Footer Decoration -->
        <div style="padding: 1rem; text-align: center; background: rgba(0,0,0,0.2); border-top: 1px solid rgba(255,255,255,0.05);">
            <div style="font-size: 0.7rem; color: #475569; font-weight: 700; text-transform: uppercase; letter-spacing: 0.2em;">
                System Core // Secure Terminal
            </div>
        </div>
    </div>
</div>

<!-- Inline Animations -->
<style>
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    @keyframes slideUp {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endsection
