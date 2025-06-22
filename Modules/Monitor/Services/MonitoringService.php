<?php

namespace Modules\Monitor\Services;

use Modules\Monitor\Interfaces\MonitoringServiceInterface;
use Modules\Monitor\Interfaces\SystemLogRepositoryInterface;

class MonitoringService implements MonitoringServiceInterface {
    public function __construct(
        private SystemLogRepositoryInterface $repository,
    ){}

    public function logAction(string $action, ?int $userId, array $metadata = []){
        $this->repository->createLog([
            'action'=> $action,
            'user_id'=> $userId,
            'ip_address'=>request()->ip(),
            'metadata' => json_encode($metadata),
        ]);
    }

    public function getLogs()
    {
        return $this->repository->getAll();
    }
}
