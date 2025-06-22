<?php

namespace Modules\Monitor\Interfaces;

interface MonitoringServiceInterface {
    public function logAction(string $action, ?int $userId, array $metadata = []);
}
