<?php

namespace Modules\Shipment\Interfaces;
use Modules\Shipment\DTOs\ShipmentCreateDTO;
use Modules\Shipment\DTOs\UpdateShipmentDTO;
use Modules\Shipment\Models\Shipment;

interface ShipmentServiceInterface {
    
    public function create(ShipmentCreateDTO $dto, $user);
    public function updateShipment(Shipment $shipment, UpdateShipmentDTO $data) :  Shipment;
    public function getShipmentByTrackingNumber(string $tracking);
}
