<?php
namespace Modules\Shipment\Repositories;

use Illuminate\Pagination\LengthAwarePaginator;
use Modules\Shipment\DTOs\UpdateShipmentDTO;
use Modules\Shipment\Interfaces\ShipmentRepositoryInterface;
use Modules\Shipment\Models\Shipment;

class ShipmentRepository implements ShipmentRepositoryInterface
{
    protected string $model = Shipment::class;

    public function create(array $data) : Shipment
    {
        return $this->model::create($data);
    }

    public function update(Shipment $shipment, UpdateShipmentDTO $data): Shipment
    {
        if ($data->status) {
            $shipment->status = (string)$data->status;
        }

        $shipment->save();
        return $shipment;
    }

    public function getAll(array $filters = []): LengthAwarePaginator
    {
        $query = $this->model::query();

        if (isset($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        if (isset($filters['user_id'])) {
            $query->where('created_by', $filters['user_id']);
        }

        return $query->paginate(10);
    }

    public function findByTrackingNumber(string $trackingNumber): ?Shipment
    {
        return Shipment::where('tracking_number', $trackingNumber)->first();
    }
}
