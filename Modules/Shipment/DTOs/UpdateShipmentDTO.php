<?php
namespace Modules\Shipment\DTOs;

class UpdateShipmentDTO
{
    public function __construct(
        public ?string $status = null,
    ) {}
}