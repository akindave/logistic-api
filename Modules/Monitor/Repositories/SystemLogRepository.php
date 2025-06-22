<?php
namespace Modules\Monitor\Repositories;
use Modules\Monitor\Interfaces\SystemLogRepositoryInterface;
use Modules\Monitor\Models\SystemLog;

class SystemLogRepository implements SystemLogRepositoryInterface
{
    protected string $model = SystemLog::class;

    public function createLog(array $array)
    {
        $this->model::create($array);
    }

    public function getAll()
    {
        return $this->model::latest()->paginate(10);
    }


   
}
