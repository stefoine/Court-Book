<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AnnouncementManagementController extends Controller
{
    public function index()
    {
        Gate::authorize('manage-announcements');
        $announcements = Announcement::latest()->paginate(10);
        return view('admin.announcements.index', compact('announcements'));
    }

    public function create() { Gate::authorize('manage-announcements'); return view('admin.announcements.create'); }

    public function store(Request $request)
    {
        Gate::authorize('manage-announcements');
        $data = $request->validate([
            'title' => ['required','string','max:160'],
            'body'  => ['required','string','max:5000'],
            'is_published' => ['nullable','boolean'],
        ]);
        $data['user_id'] = $request->user()->id;
        $data['is_published'] = $request->boolean('is_published', true);
        Announcement::create($data);
        return redirect()->route('admin.announcements.index')->with('success', 'Announcement posted.');
    }

    public function edit(Announcement $announcement)
    {
        Gate::authorize('manage-announcements');
        return view('admin.announcements.edit', compact('announcement'));
    }

    public function update(Request $request, Announcement $announcement)
    {
        Gate::authorize('manage-announcements');
        $data = $request->validate([
            'title' => ['required','string','max:160'],
            'body'  => ['required','string','max:5000'],
            'is_published' => ['nullable','boolean'],
        ]);
        $data['is_published'] = $request->boolean('is_published', false);
        $announcement->update($data);
        return redirect()->route('admin.announcements.index')->with('success', 'Updated.');
    }

    public function destroy(Announcement $announcement)
    {
        Gate::authorize('manage-announcements');
        $announcement->delete();
        return back()->with('success', 'Deleted.');
    }
}
