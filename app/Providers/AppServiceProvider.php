<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use App\Models\Booking;
use App\Models\Court;
use App\Policies\BookingPolicy;
use App\Policies\CourtPolicy;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        // Policies
        Gate::policy(Booking::class, BookingPolicy::class);
        Gate::policy(Court::class, CourtPolicy::class);

        // Gates registered via Service Provider
        Gate::define('access-admin-dashboard', fn ($user) => $user->isAdmin());
        Gate::define('manage-reports',         fn ($user) => $user->isAdmin());
        Gate::define('manage-users',           fn ($user) => $user->isAdmin());
        Gate::define('manage-announcements',   fn ($user) => $user->isAdmin());

        // Share announcements with all views (lightweight global)
        view()->composer('layouts.app', function ($view) {
            $view->with('globalAnnouncements',
                \App\Models\Announcement::where('is_published', true)
                    ->latest()->take(3)->get()
            );
        });
    }
}
