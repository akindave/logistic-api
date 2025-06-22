<?php

namespace Modules\Shipment\Interfaces;

interface GeolocationServiceInterface {
    public function getCoordinates(string $address): ?array;
}
