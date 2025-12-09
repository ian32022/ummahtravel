<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'package_id',
        'package_date_id',
        'room_type',
        'total_price',
        'status',
        'payment_status',
        'payment_method',
        'payment_proof',
        'payment_date'
    ];

    protected $casts = [
        'total_price' => 'decimal:2',
        'payment_date' => 'datetime'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function packageDate()
    {
        return $this->belongsTo(PackageDate::class);
    }
}