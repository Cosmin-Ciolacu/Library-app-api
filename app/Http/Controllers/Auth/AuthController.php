<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function __construct(private readonly UserService $userService) {}
    public function login(LoginRequest $request) {
        $data = $request->validated();

        $user = $this->userService->findByEmail($data['email']);
        if (!$user || !Hash::check($data['password'], $user->password)) {
            return response()->json([
                'invalidCredentials' => true,
                'token' => null
            ], 401);
        }

        $token = $this->userService->generateToken($user);

        return response()->json(['token' => $token, 'invalidCredentials' => false]);
    }

    public function register(RegisterRequest $request) {
        $data = $request->validated();

        $user = $this->userService->create($data);

        $token = $this->userService->generateToken($user);

        return response()->json(['token' => $token]);
    }

    public function logout() {
        auth()->user()->tokens()->delete();

        return response()->json(['message' => 'Logged out']);
    }
}
