<?php

namespace Modules\Monitor\Interfaces;

interface SystemLogRepositoryInterface {
    public function createLog(array $array);
    public function getAll();
}
