<?php

namespace Modules\Shipment\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Shipment\App\Enums\ShipmentStatus;

class UpdateShipmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->isAdmin();
    }

    public function rules(): array
    {
        return [
            'status' => 'sometimes|in:'.implode(',', ShipmentStatus::values()),
        ];
    }
}
