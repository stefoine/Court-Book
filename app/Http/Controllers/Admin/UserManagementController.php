<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UserManagementController extends Controller
{
    public function index(Request $request)
    {
        Gate::authorize('manage-users');
        $users = User::when($request->search, fn($q,$s) =>
                $q->where('name','like',"%{$s}%")->orWhere('email','like',"%{$s}%"))
            ->latest()->paginate(15)->withQueryString();
        return view('admin.users.index', compact('users'));
    }

    public function toggleBan(User $user)
    {
        Gate::authorize('manage-users');
        abort_if($user->id === auth()->id(), 403, 'Cannot ban yourself.');
        $user->update(['is_banned' => ! $user->is_banned]);
        return back()->with('success', $user->is_banned ? 'User banned.' : 'User unbanned.');
    }

    public function changeRole(Request $request, User $user)
    {
        Gate::authorize('manage-users');
        $request->validate(['role' => ['required', 'in:admin,user']]);
        abort_if($user->id === auth()->id(), 403);
        $user->update(['role' => $request->role]);
        return back()->with('success', 'Role updated.');
    }
}
