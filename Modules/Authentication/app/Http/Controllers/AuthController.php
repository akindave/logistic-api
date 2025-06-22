<?php

namespace Modules\Authentication\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Authentication\DTOs\LoginDTO;
use Modules\Authentication\DTOs\RegisterDTO;
use Modules\Authentication\Http\Requests\LoginRequest;
use Modules\Authentication\Http\Requests\RegisterRequest;
use Modules\Authentication\Services\AuthService;

class AuthController extends Controller
{
    public function __construct(private AuthService $authService) {}

    public function register(RegisterRequest $request): JsonResponse
    {
        $user_reg_dto = new RegisterDTO($request->validated());
        $user = $this->authService->register($user_reg_dto);
        return response()->json(['user' => $user], 201);
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $user_login_dto = new LoginDTO($request->validated());
        $user = $this->authService->login($user_login_dto);
        return response()->json(['user' => $user],200);
    }

    public function logout(Request $request): JsonResponse
    {
        $request->user()->tokens()->delete();

        return response()->json(['message' => 'Successfully logged out'],200);
    }

}
