<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\EmptyResource;
use App\Http\Resources\TokenResource;
use App\Http\Resources\UserResource;
use App\Http\Services\AuthService;

final class AuthController
{
    public function __construct(
        private readonly AuthService $authService
    )
    {
    }

    public function register(RegisterRequest $request): UserResource
    {
        return new UserResource($this->authService->register($request->validated()));
    }

    public function login(LoginRequest $request): TokenResource
    {
        return new TokenResource($this->authService->login($request->validated()));
    }

    public function logout()
    {
        $this->authService->logout();

        return new EmptyResource();
    }
}
