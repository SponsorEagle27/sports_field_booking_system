<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    protected $fillable = [
        'user_id',
        'sports_field_id',
        'booking_date',
        'start_time',
        'end_time',
        'total_price',
        'status',
        'payment_method',
        'payment_status',
        'bkash_txn',
        'bkash_ref',
        'notes',
    ];

    protected $casts = [
        'booking_date' => 'date',
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'total_price' => 'integer',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function sportsField(): BelongsTo
    {
        return $this->belongsTo(SportsField::class);
    }
}
