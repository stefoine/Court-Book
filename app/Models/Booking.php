<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    use HasFactory;

    public const STATUSES = ['pending', 'approved', 'rejected', 'cancelled', 'completed'];

    protected $fillable = [
        'user_id', 'court_id', 'sport_type', 'purpose',
        'booking_date', 'start_time', 'end_time',
        'notes', 'status', 'payment_proof', 'admin_remark', 'total_price',
    ];

    protected $casts = [
        'booking_date' => 'date',
        'total_price'  => 'decimal:2',
    ];

    public function user(): BelongsTo  { return $this->belongsTo(User::class); }
    public function court(): BelongsTo { return $this->belongsTo(Court::class); }

    public function scopeStatus($q, string $status) { return $q->where('status', $status); }

    public function isEditable(): bool { return $this->status === 'pending'; }
}
