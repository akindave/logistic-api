<?php

namespace Modules\Authentication\Interfaces;
use Modules\Authentication\DTOs\LoginDTO;
use Modules\Authentication\DTOs\RegisterDTO;

interface AuthServiceInterface {
    public function register(RegisterDTO $dto);
    public function login(LoginDTO $dto);
}
