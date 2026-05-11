<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Court extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'type', 'capacity', 'hourly_rate',
        'description', 'image', 'is_available',
    ];

    protected $casts = [
        'is_available' => 'boolean',
        'hourly_rate'  => 'decimal:2',
        'capacity'     => 'integer',
    ];

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }
}
