<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    /**
     * Get authenticated user's details.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        return response()->json([
            'status' => true,
            'message' => 'User details fetched successfully.',
            'data' => [
                'user' => $request->user()
            ]
        ]);
    }

    /**
     * Destroy authenticated user's sessions.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'status' => true,
            'message' => 'User logged out successfully.',
            'data' => null
        ]);
    }
}
