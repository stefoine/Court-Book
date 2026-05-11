<?php

namespace App\Http\Requests;

class UpdateBookingRequest extends StoreBookingRequest
{
    public function authorize(): bool
    {
        $booking = $this->route('booking');
        return $booking && $this->user()->can('update', $booking);
    }
}
