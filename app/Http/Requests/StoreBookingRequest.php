<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Booking;

class StoreBookingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() && ! $this->user()->is_banned;
    }

    public function rules(): array
    {
        return [
            'court_id'     => ['required', 'exists:courts,id'],
            'sport_type'   => ['required', 'string', Rule::in([
                'Basketball','Volleyball','Badminton','Futsal',
                'Training Session','School Event','Community Event',
            ])],
            'purpose'      => ['required', 'string', 'max:255'],
            'booking_date' => ['required', 'date', 'after_or_equal:today'],
            'start_time'   => ['required', 'date_format:H:i'],
            'end_time'     => ['required', 'date_format:H:i', 'after:start_time'],
            'notes'        => ['nullable', 'string', 'max:1000'],
            'payment_proof'=> ['nullable', 'image', 'max:2048'],
        ];
    }

    public function withValidator($validator): void
    {
        $validator->after(function ($v) {
            $exists = Booking::where('court_id', $this->court_id)
                ->where('booking_date', $this->booking_date)
                ->whereIn('status', ['pending', 'approved'])
                ->where(function ($q) {
                    $q->whereBetween('start_time', [$this->start_time, $this->end_time])
                      ->orWhereBetween('end_time', [$this->start_time, $this->end_time])
                      ->orWhere(function ($q2) {
                          $q2->where('start_time', '<=', $this->start_time)
                             ->where('end_time', '>=', $this->end_time);
                      });
                })
                ->when($this->route('booking'), fn($q,$id) => $q->where('id', '!=', $id))
                ->exists();

            if ($exists) {
                $v->errors()->add('start_time', 'This time slot is already booked for the selected court.');
            }
        });
    }
}
