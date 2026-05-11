<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourtRequest extends FormRequest
{
    public function authorize(): bool { return $this->user()?->isAdmin() ?? false; }

    public function rules(): array
    {
        return [
            'name'         => ['required', 'string', 'max:120'],
            'type'         => ['required', 'string', 'max:80'],
            'capacity'     => ['required', 'integer', 'min:1', 'max:1000'],
            'hourly_rate'  => ['required', 'numeric', 'min:0'],
            'description'  => ['nullable', 'string', 'max:2000'],
            'image'        => ['nullable', 'image', 'max:2048'],
            'is_available' => ['nullable', 'boolean'],
        ];
    }
}
