<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Api\Traits\ApiResponser;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\RegisterRequest;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    use ApiResponser;

    /**
     * @param RegisterRequest $request
     * @return JsonResponse
     */
    public function register(RegisterRequest $request):JsonResponse
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'type' => $request->type ?? 'user',
            'phone_number' => $request->phone,
            'interesting_type_id' => $request->interesting_type ?? null,
            'additional_type' => $request->additional_type ?? null,
            'organisation_description' => $request->organisation_description ?? null,
            'api_token' => str_random(60),
            'country_id' => $request->country
        ]);

        $token = $user->createToken($user->name)->plainTextToken;
        return $this->successResponse([
            'message' => __('AuthApi.msg.registerSuccess'),
            'token' => $token,
            'user' => UserResource::make($user->load(['country']))->only(['name','email','type','image'])
        ]);
    }
}
