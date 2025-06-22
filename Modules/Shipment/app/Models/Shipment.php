<?php

namespace Modules\Shipment\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Shipment\App\Enums\ShipmentStatus;

// use Modules\Shipment\Database\Factories\ShipmentFactory;

class Shipment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'tracking_number',
        'sender_name',
        'receiver_name',
        'origin_address',
        'destination_address',
        'origin_coords',
        'destination_coords',
        'status',
        'created_by',
    ];

    protected $casts = [
        'status' => ShipmentStatus::class,
    ];

    // protected static function newFactory(): ShipmentFactory
    // {
    //     // return ShipmentFactory::new();
    // }

    protected static function booted()
    {
        static::creating(function ($shipment) {
            $shipment->tracking_number = substr(md5(uniqid()), 0, 10);
        });
    }
}
