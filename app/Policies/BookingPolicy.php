<?php

namespace App\Policies;

use App\Models\Booking;
use App\Models\User;

class BookingPolicy
{
    public function viewAny(User $user): bool { return true; }

    public function view(User $user, Booking $booking): bool
    {
        return $user->isAdmin() || $user->id === $booking->user_id;
    }

    public function create(User $user): bool { return ! $user->is_banned; }

    public function update(User $user, Booking $booking): bool
    {
        return $user->id === $booking->user_id && $booking->isEditable();
    }

    public function cancel(User $user, Booking $booking): bool
    {
        return $user->id === $booking->user_id
            && in_array($booking->status, ['pending', 'approved']);
    }

    public function manage(User $user): bool { return $user->isAdmin(); }

    public function delete(User $user, Booking $booking): bool
    {
        return $user->isAdmin();
    }
}
