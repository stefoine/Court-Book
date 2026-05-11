@extends('layouts.app')
@section('title','Profile') @section('header','Profile Settings')
@section('content')
<div class="grid lg:grid-cols-2 gap-6">
    <div class="card">
        <h3 class="font-semibold mb-3">Profile information</h3>
        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-3">
            @csrf @method('PATCH')
            @if($user->avatar)
                <img src="{{ asset('storage/'.$user->avatar) }}" class="size-20 rounded-full object-cover">
            @endif
            <div><label class="text-sm">Avatar</label><input type="file" name="avatar" accept="image/*" class="input"></div>
            <div><label class="text-sm">Name</label><input class="input" name="name" value="{{ old('name',$user->name) }}" required></div>
            <div><label class="text-sm">Email</label><input class="input" type="email" name="email" value="{{ old('email',$user->email) }}" required></div>
            <div><label class="text-sm">Phone</label><input class="input" name="phone" value="{{ old('phone',$user->phone) }}"></div>
            <button class="btn-primary">Save changes</button>
        </form>
    </div>

    <div class="card">
        <h3 class="font-semibold mb-3">Change password</h3>
        <form method="POST" action="{{ route('profile.password') }}" class="space-y-3">
            @csrf @method('PUT')
            <div><label class="text-sm">Current password</label><input class="input" type="password" name="current_password" required></div>
            <div><label class="text-sm">New password</label><input class="input" type="password" name="password" required></div>
            <div><label class="text-sm">Confirm new password</label><input class="input" type="password" name="password_confirmation" required></div>
            <button class="btn-primary">Update password</button>
        </form>
    </div>
</div>
@endsection
