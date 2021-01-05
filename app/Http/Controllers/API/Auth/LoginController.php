<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class LoginController extends Controller
{
    private User $user;

    /**
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Log user into the application.
     *
     * @param LoginRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws ValidationException
     */
    public function login(LoginRequest $request)
    {
        $user = $this->user->where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $token = $user->createToken('token')->plainTextToken;

        return response()->json([
            'status' => true,
            'message' => 'User logged in successfully.',
            'data' => [
                'user' => $user,
                'token' => $token
            ]
        ]);
    }
}
