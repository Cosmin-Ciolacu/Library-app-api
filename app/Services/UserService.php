<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{

    public function create(array $data): User
    {
        return User::create([
            ...$data,
            'password' => Hash::make($data['password'])
        ]);
    }

    public function findByEmail(string $email)
    {
        return User::query()->where('email', $email)->first();
    }

    public function generateToken(User $user): string
    {
        return $user->createToken('token-name')->plainTextToken;
    }
}
