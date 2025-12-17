<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    protected $fillable = [
        'user_id',
        'package_id',
        'package_date_id',
        'room_type',
        'total_price',
        'status',
        'payment_status',
        'payment_proof',
        'payment_method',
        'payment_date',
        'emergency_contact_name',
        'emergency_contact_phone',
        'notes'
    ];

    protected $casts = [
        'total_price' => 'integer',
        'payment_date' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function package(): BelongsTo
    {
        return $this->belongsTo(Package::class);
    }

    public function packageDate(): BelongsTo
    {
        return $this->belongsTo(PackageDate::class);
    }
}