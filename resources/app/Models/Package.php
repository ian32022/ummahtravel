<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

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
        'facilities' => 'array',
        'is_active' => 'boolean'
    ];

    public function dates()
    {
        return $this->hasMany(PackageDate::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function getPriceByRoomType($roomType)
    {
        return match($roomType) {
            'double' => $this->double_price,
            'triple' => $this->triple_price,
            'quad' => $this->quad_price,
            default => 0
        };
    }
}
