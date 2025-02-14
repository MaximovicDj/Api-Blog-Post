<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\UpdateProfileRequest;
use App\Http\Resources\Api\V1\UserResource;
use App\Models\User;
use App\Traits\ApiResponses;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    use ApiResponses;

    /**
     * Display a listing of the resource.
     * @return UserResource
     */
    public function show(): UserResource
    {
        return new UserResource(auth()->user());
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateProfileRequest $request
     * @return UserResource
     */
    public function update(UpdateProfileRequest $request): UserResource
    {
        $request->user()->update($request->validated());
        return new UserResource(auth()->user());
    }

    /**
     * Remove the specified resource from storage.
     * @param Request $request
     * @return JsonResponse
     */
    public function destroy(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();
        $request->user()->delete();
        return $this->successResponse('User deleted successfully');
    }
}
