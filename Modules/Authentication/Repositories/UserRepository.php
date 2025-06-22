<?php
namespace Modules\Authentication\Repositories;
use Modules\Authentication\Interfaces\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    protected string $model = User::class;

    public function register(array $data) : User
    {
        return $this->model::create($data);
    }

    public function getUserByEmail(string $email): ?User
    {
        return $this->model::where('email', $email)->first();
    }
}
