<?php

namespace Modules\Shipment\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Shipment\Models\Shipment;

class ShipmentPolicy
{
    use HandlesAuthorization;

    public function view(User $user, Shipment $shipment)
    {
        return $user->isAdmin() || $shipment->created_by === $user->id;
    }

    public function update(User $user, Shipment $shipment)
    {
        return $user->isAdmin();
    }
}
