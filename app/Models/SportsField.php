<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SportsField extends Model
{
    protected $fillable = [
        'name',
        'description',
        'type',
        'location',
        'price_per_hour',
        'status',
        'image',
        'amenities',
        'opening_time',
        'closing_time',
    ];

    protected $casts = [
        'amenities' => 'array',
        'opening_time' => 'datetime',
        'closing_time' => 'datetime',
    ];

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }
}
