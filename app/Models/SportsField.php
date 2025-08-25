<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class SportsField extends Model
{
    protected $fillable = [
        'name',
        'sport_type',
        'description',
        'type',
        'location',
        'address',
        'size',
        'surface',
        'price_per_90min',
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
        'price_per_90min' => 'decimal:2',
    ];

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    public function favoritedBy(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'favorites')->withTimestamps();
    }
}
