<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Package extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'duration_days',
        'type',
        'double_price',
        'triple_price',
        'quad_price',
        'airline',
        'hotel_madinah',
        'hotel_makkah',
        'facilities',
        'image_url',
        'is_active'
    ];

    protected $casts = [
        'double_price' => 'integer',
        'triple_price' => 'integer',
        'quad_price' => 'integer',
        'is_active' => 'boolean',
        'facilities' => 'array'
    ];

    public function dates(): HasMany
    {
        return $this->hasMany(PackageDate::class);
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    public function getPriceByRoomType($roomType): int
    {
        return match($roomType) {
            'double' => $this->double_price,
            'triple' => $this->triple_price,
            'quad' => $this->quad_price,
            default => $this->double_price
        };
    }
}