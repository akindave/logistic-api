<?php

namespace Modules\Shipment\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Shipment\DTOs\ShipmentCreateDTO;
use Modules\Shipment\DTOs\UpdateShipmentDTO;
use Modules\Shipment\Http\Requests\CreateShipmentRequest;
use Modules\Shipment\Http\Requests\UpdateShipmentRequest;
use Modules\Shipment\Models\Shipment;
use Modules\Shipment\Services\ShipmentService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ShipmentController extends Controller
{
    use AuthorizesRequests;
    
    public function __construct(private ShipmentService $shipmentService) {}

    public function index(Request $request): JsonResponse
    {
        $filters = ['status' => $request->input('status')];
        
        if (!Auth::user()->isAdmin()) {
            $filters['user_id'] = Auth::id();
        }

        $shipments = $this->shipmentService->getAllShipments($filters);
        
        return response()->json($shipments,200);
    }

    public function store(CreateShipmentRequest $request): JsonResponse
    {
        $dto = new ShipmentCreateDTO(
            $request->validated()
        );
        $shipment = $this->shipmentService->create($dto, Auth::user());
        return response()->json($shipment, 201);
    }

    public function update(Shipment $shipment, UpdateShipmentRequest $request)
    {
        $this->authorize('update', $shipment);

        $data = new UpdateShipmentDTO(
            status: $request->input('status'),
        );

        $shipment = $this->shipmentService->updateShipment($shipment, $data);

        return response()->json($shipment);
    }
    
    public function trackLogistic(string $trackingNumber): JsonResponse
    {
        $shipment = $this->shipmentService->getShipmentByTrackingNumber($trackingNumber);

        if (!$shipment) {
            return response()->json(['message' => 'Shipment not found'], 404);
        }

        return response()->json($shipment,200);
    }
}
