<?php

namespace Modules\Shipment\Interfaces;

use Illuminate\Pagination\LengthAwarePaginator;
use Modules\Shipment\DTOs\ShipmentCreateDTO;
use Modules\Shipment\DTOs\UpdateShipmentDTO;
use Modules\Shipment\Models\Shipment;

interface ShipmentRepositoryInterface {
    public function create(array $data): Shipment;
    public function getAll(array $filters = []): LengthAwarePaginator;
    public function findByTrackingNumber(string $trackingNumber): ?Shipment;
    public function update(Shipment $shipment, UpdateShipmentDTO $data): Shipment;
}
