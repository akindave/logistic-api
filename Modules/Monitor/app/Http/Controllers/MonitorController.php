<?php

namespace Modules\Monitor\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Monitor\Services\MonitoringService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Modules\Monitor\Models\SystemLog;

class MonitorController extends Controller
{
    use AuthorizesRequests;

    public function __construct(private MonitoringService $monitoringService) {}
    public function index(): JsonResponse
    {
        $this->authorize('view',SystemLog::class);
        $logs = $this->monitoringService->getLogs();
        return response()->json($logs,200);
    }
}
