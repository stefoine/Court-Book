@extends('layouts.app')

@section('title', 'Announcements')
@section('header', 'Manage Announcements')

@section('content')
<!-- Dashboard Main Container -->
<div style="min-height: 100vh; padding: 1.5rem; font-family: 'Inter', system-ui, -apple-system, sans-serif; background: radial-gradient(circle at top right, #1e293b, #0f172a); color: #f8fafc; animation: fadeIn 0.8s ease-out;">

    <!-- Card Wrapper: Glassmorphism Effect -->
    <div style="max-width: 1200px; margin: 0 auto; background: rgba(30, 41, 59, 0.4); backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 24px; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5); overflow: hidden; animation: slideUp 0.6s cubic-bezier(0.16, 1, 0.3, 1);">
        
        <!-- Header Section -->
        <div style="padding: 2rem; border-bottom: 1px solid rgba(255, 255, 255, 0.05); display: flex; flex-wrap: wrap; justify-content: space-between; align-items: center; gap: 1.5rem;">
            <div style="flex: 1; min-width: 250px;">
                <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 0.5rem;">
                    <div style="width: 8px; height: 24px; background: #22d3ee; border-radius: 4px; box-shadow: 0 0 15px rgba(34, 211, 238, 0.5);"></div>
                    <h3 style="color: #fff; font-weight: 800; font-size: 1.75rem; margin: 0; letter-spacing: -0.025em; text-shadow: 0 0 20px rgba(255,255,255,0.1);">Global Logs</h3>
                </div>
                <p style="color: #94a3b8; font-size: 0.85rem; margin: 0; text-transform: uppercase; letter-spacing: 0.1em; font-weight: 500; opacity: 0.8;">Secure Registry of System-Wide Broadcasts</p>
            </div>

            <!-- Action Button: Futuristic Interaction -->
            <a href="{{ route('admin.announcements.create') }}" 
               style="background: linear-gradient(135deg, #22d3ee 0%, #0891b2 100%); color: #000; padding: 0.85rem 1.75rem; border-radius: 14px; text-decoration: none; font-weight: 700; font-size: 0.9rem; text-transform: uppercase; letter-spacing: 0.5px; transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275); display: flex; align-items: center; gap: 10px; border: 1px solid rgba(34, 211, 238, 0.3); box-shadow: 0 4px 15px rgba(34, 211, 238, 0.2);"
               onmouseover="this.style.transform='translateY(-3px) scale(1.02)'; this.style.boxShadow='0 10px 25px rgba(34, 211, 238, 0.4)'; this.style.filter='brightness(1.1)';"
               onmouseout="this.style.transform='translateY(0) scale(1)'; this.style.boxShadow='0 4px 15px rgba(34, 211, 238, 0.2)'; this.style.filter='brightness(1)';"
            >
                <span style="font-size: 1.25rem; font-weight: 400; background: rgba(0,0,0,0.1); width: 24px; height: 24px; display: flex; align-items: center; justify-content: center; border-radius: 6px;">+</span> 
                New Broadcast
            </a>
        </div>

        <!-- Table / Data Section -->
        <div style="padding: 1rem 2rem 2rem; overflow-x: auto;">
            <table style="width: 100%; border-collapse: separate; border-spacing: 0 12px;">
                <thead>
                    <tr style="text-align: left;">
                        <th style="padding: 0.75rem 1.25rem; color: #64748b; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.15em; font-weight: 700;">Subject</th>
                        <th style="padding: 0.75rem 1.25rem; color: #64748b; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.15em; font-weight: 700;">Status</th>
                        <th style="padding: 0.75rem 1.25rem; color: #64748b; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.15em; font-weight: 700;">Deployment</th>
                        <th style="padding: 0.75rem 1.25rem; color: #64748b; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.15em; font-weight: 700; text-align: right;">Operations</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($announcements as $a)
                    <!-- Dynamic Row Item -->
                    <tr style="background: rgba(255, 255, 255, 0.03); transition: all 0.3s ease; border-radius: 16px; border: 1px solid rgba(255,255,255,0.02);"
                        onmouseover="this.style.background='rgba(255, 255, 255, 0.07)'; this.style.transform='translateX(5px)'; this.style.borderColor='rgba(34, 211, 238, 0.2)';"
                        onmouseout="this.style.background='rgba(255, 255, 255, 0.03)'; this.style.transform='translateX(0)'; this.style.borderColor='rgba(255,255,255,0.02)';"
                    >
                        <td style="padding: 1.5rem 1.25rem; border-radius: 16px 0 0 16px;">
                            <div style="font-weight: 600; color: #fff; font-size: 0.95rem; margin-bottom: 2px;">{{ $a->title }}</div>
                            <div style="font-size: 0.75rem; color: #475569;">#{{ $a->id ?? 'LOG-' . $loop->iteration }}</div>
                        </td>
                        <td style="padding: 1.5rem 1.25rem;">
                            @if($a->is_published)
                            <div style="display: flex; align-items: center; gap: 8px;">
                                <span style="width: 6px; height: 6px; background: #10b981; border-radius: 50%; box-shadow: 0 0 10px #10b981;"></span>
                                <span style="background: rgba(16, 185, 129, 0.1); color: #10b981; padding: 4px 14px; border-radius: 20px; font-size: 0.7rem; font-weight: 800; text-transform: uppercase; border: 1px solid rgba(16, 185, 129, 0.2);">Live</span>
                            </div>
                            @else
                            <div style="display: flex; align-items: center; gap: 8px;">
                                <span style="width: 6px; height: 6px; background: #f43f5e; border-radius: 50%;"></span>
                                <span style="background: rgba(244, 63, 94, 0.1); color: #f43f5e; padding: 4px 14px; border-radius: 20px; font-size: 0.7rem; font-weight: 800; text-transform: uppercase; border: 1px solid rgba(244, 63, 94, 0.2);">Stored</span>
                            </div>
                            @endif
                        </td>
                        <td style="padding: 1.5rem 1.25rem; color: #cbd5e1; font-size: 0.85rem; font-family: 'JetBrains Mono', 'Fira Code', monospace;">
                            {{ $a->created_at->format('M d, Y') }}
                        </td>
                        <td style="padding: 1.5rem 1.25rem; border-radius: 0 16px 16px 0; text-align: right;">
                            <div style="display: inline-flex; gap: 8px; align-items: center; background: rgba(0,0,0,0.2); padding: 4px; border-radius: 10px;">
                                <!-- Edit Control -->
                                <a href="{{ route('admin.announcements.edit',$a) }}" 
                                   style="color: #fbbf24; background: rgba(251, 191, 36, 0.1); padding: 8px 16px; border-radius: 8px; text-decoration: none; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; transition: all 0.2s;"
                                   onmouseover="this.style.background='rgba(251, 191, 36, 0.2)'; this.style.color='#fff';"
                                   onmouseout="this.style.background='rgba(251, 191, 36, 0.1)'; this.style.color='#fbbf24';">
                                   Edit
                                </a>
                                <!-- Delete Control -->
                                <form method="POST" action="{{ route('admin.announcements.destroy',$a) }}" style="display: inline;">
                                    @csrf @method('DELETE')
                                    <button style="background: rgba(244, 63, 94, 0.1); border: none; color: #f43f5e; padding: 8px 16px; border-radius: 8px; cursor: pointer; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; transition: all 0.2s;"
                                            onmouseover="this.style.background='rgba(244, 63, 94, 0.2)'; this.style.color='#fff';"
                                            onmouseout="this.style.background='rgba(244, 63, 94, 0.1)'; this.style.color='#f43f5e';"
                                            onclick="return confirm('Critical Action: Confirm permanent erasure of this record?')">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination Section -->
        <div style="padding: 1.5rem 2rem; background: rgba(0,0,0,0.1); border-top: 1px solid rgba(255,255,255,0.05); display: flex; justify-content: space-between; align-items: center;">
            <div style="font-size: 0.8rem; color: #475569; font-weight: 500;">
                Showing system audit trails
            </div>
            <div style="opacity: 0.9; transition: 0.3s;" onmouseover="this.style.opacity='1'" onmouseout="this.style.opacity='0.9'">
                {{ $announcements->links() }}
            </div>
        </div>
    </div>
</div>

<!-- Inline Styles for Animations -->
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
