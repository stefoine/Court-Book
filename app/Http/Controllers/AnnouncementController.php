<?php

namespace App\Http\Controllers;

use App\Models\Announcement;

class AnnouncementController extends Controller
{
    public function index()
    {
        $announcements = Announcement::with('user')
            ->where('is_published', true)->latest()->paginate(10);
        return view('announcements.index', compact('announcements'));
    }
}
