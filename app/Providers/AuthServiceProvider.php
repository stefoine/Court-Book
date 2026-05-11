<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\Booking;
use App\Models\Court;
use App\Policies\BookingPolicy;
use App\Policies\CourtPolicy;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Booking::class => BookingPolicy::class,
        Court::class   => CourtPolicy::class,
    ];

    public function boot(): void
    {
        $this->registerPolicies();
    }
}
