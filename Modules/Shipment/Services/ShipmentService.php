<?php

namespace Modules\Shipment\Services;
use Illuminate\Support\Str;
use Modules\Monitor\Jobs\LogShipmentActivity;
use Modules\Shipment\DTOs\ShipmentCreateDTO;
use Modules\Shipment\DTOs\UpdateShipmentDTO;
use Modules\Shipment\Interfaces\GeolocationServiceInterface;
use Modules\Shipment\Interfaces\ShipmentRepositoryInterface;
use Modules\Shipment\Interfaces\ShipmentServiceInterface;
use Modules\Shipment\Models\Shipment;


class ShipmentService implements ShipmentServiceInterface {
    public function __construct(
        private ShipmentRepositoryInterface $repository,
        private GeolocationServiceInterface $geolocationService
    ) {}

    public function create(ShipmentCreateDTO $dto, $user){
       $originCoords = $this->geolocationService->getCoordinates($dto->origin_address);
        $destinationCoords = $this->geolocationService->getCoordinates($dto->destination_address);
    
        $shipment = $this->repository->create([
          'sender_name'=>$dto->sender_name,
          'receiver_name'=>$dto->receiver_name,
          'origin_address'=>$dto->origin_address,
          'destination_address'=>$dto->destination_address,
          'origin_coords'=> "{$originCoords['lat']},{$originCoords['lng']}",
          'destination_coords'=> "{$destinationCoords['lat']},{$destinationCoords['lng']}",
          'created_by'=>$user->id
        ]);
        LogShipmentActivity::dispatch(
            action: 'shipment.creation',
            userId: $user->id,
            ipAddress: request()->ip(),
            metadata: ['shipment' => $shipment]
        );
    
        return $shipment;
      }

      public function getAllShipments(array $filters = []): \Illuminate\Pagination\LengthAwarePaginator
    {
        return $this->repository->getAll($filters);
    }

    public function getShipmentByTrackingNumber(string $trackingNumber): ?Shipment
    {
        return $this->repository->findByTrackingNumber($trackingNumber);
    }

    public function updateShipment(Shipment $shipment, UpdateShipmentDTO $data): Shipment
    {
        LogShipmentActivity::dispatch(
            action: 'shipment.update',
            userId: auth()->id(),
            ipAddress: request()->ip(),
            metadata: ['shipment' => $shipment]
        );
        return $this->repository->update($shipment, $data);
    }

    
}
