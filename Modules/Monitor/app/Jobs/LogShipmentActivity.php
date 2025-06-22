<?php

namespace Modules\Monitor\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Modules\Monitor\Interfaces\MonitoringServiceInterface;

class LogShipmentActivity implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    
    public string $action;
    public ?int $userId;
    public string $ipAddress;
    public array $metadata;
    /**
     * Create a new job instance.
     */
    public function __construct(string $action, ?int $userId, string $ipAddress, array $metadata = []) {
       
        $this->action = $action;
        $this->userId = $userId;
        $this->ipAddress = $ipAddress;
        $this->metadata = $metadata;
    }

    /**
     * Execute the job.
     */
    public function handle(): void {
        $service = app(MonitoringServiceInterface::class);
        $service->logAction(
            $this->action,
            $this->userId,
            $this->metadata
        );
    }
}
