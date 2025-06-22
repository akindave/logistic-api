<?php

namespace Modules\Authentication\Services;
use Illuminate\Support\Facades\Hash;
use Modules\Authentication\DTOs\LoginDTO;
use Modules\Authentication\DTOs\RegisterDTO;
// use Modules\Auth\DTOs\LoginDTO;
use Modules\Authentication\Interfaces\AuthServiceInterface;
use Modules\Authentication\Interfaces\UserRepositoryInterface;
use Modules\Logging\Repositories\SystemLogRepositoryInterface;
use Modules\Monitor\Jobs\LogShipmentActivity;

class AuthService implements AuthServiceInterface {
    public function __construct(
        private UserRepositoryInterface $userRepo,
    ){}

    public function register(RegisterDTO $dto){
        $user = $this->userRepo->register([
            'name'=>$dto->name,
            'email'=>$dto->email,
            'password'=>Hash::make($dto->password),
            'role' => $dto->role
        ]);
        $token = $this->getToken($user); 
        return [$user, $token];
    }

    public function login(LoginDTO $dto){
        $user = $this->userRepo->getUserByEmail($dto->email);
        if(!$user || !Hash::check($dto->password, $user->password)){
            throw new \Exception('Invalid credentials');
        }
        LogShipmentActivity::dispatch(
            action: 'user-login',
            userId: $user->id,
            ipAddress: request()->ip(),
            metadata: ['user' => $user]
        );
        $token = $this->getToken($user); 
        return [$user, $token];
    }

    private function getToken($user){
        $token['token'] = $user->createToken('api')->plainTextToken;
        $token['type'] = "access token";
        return $token;
    }
}
