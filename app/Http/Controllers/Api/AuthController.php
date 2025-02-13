<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRequest;
use App\Models\User;
use App\Permissions\Abilities;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Traits\ApiResponses;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use ApiResponses;

    /**
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $user = User::where('email', $request->email)->first();
        if(!$user || !Hash::check($request->password, $user->password))
        {
            return $this->errorResponse('User does not exist');
        }

        $token = $user->createToken('ApiToken',
            [Abilities::setAbilities($user, $user->role->name)]
        )->plainTextToken;
        return $this->successResponse('Successful login',
            [
                'email' => $user->email,
                'token' => $token
            ]
        );
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function logout(Request $request): JsonResponse
    {
        auth()->user()->currentAccessToken()->delete();
        return $this->successResponse('Successful logout');
    }
}
