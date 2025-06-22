<?php

namespace Modules\Shipment\App\Enums;

enum ShipmentStatus: string
{
    case PENDING = 'Pending';
    case IN_TRANSIT = 'In‑Transit';
    case DELIVERED = 'Delivered';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}