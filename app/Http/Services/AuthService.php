<?php

namespace App\Http\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Laravel\Sanctum\NewAccessToken;
use Laravel\Sanctum\PersonalAccessToken;

class AuthService
{
    public function register(array $data): User
    {
        return User::create($data);
    }

    public function login(array $data): NewAccessToken
    {
        $user = User::where('email', $data['email'])->first();

        if (! $user || ! Hash::check($data['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Неправильный email или пароль!']
            ]);
        }

        return $user->createToken('auth');
    }

    public function logout(): void
    {
        Auth::user()->currentAccessToken()->delete();
    }
}
