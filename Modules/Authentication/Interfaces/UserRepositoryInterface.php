<?php

namespace Modules\Authentication\Interfaces;

use App\Models\User;

interface UserRepositoryInterface {
    public function register(array $data): User;
    public function getUserByEmail(string $email): ?User;
}
