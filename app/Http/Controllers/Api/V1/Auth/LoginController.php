<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Api\Traits\ApiResponser;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    use ApiResponser;

    public function login(LoginRequest $request)
    {
        $user = User::where("email", $request->email)->first();

        if(!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => [__("AuthApi.msg.incorrectCredentials")],
            ]);
        }

        $token = $user->createToken($user->name)->plainTextToken;
        return $this->successResponse([
            'token' => $token,
            'data' => UserResource::make($user->load(['country','interesting_type']))->hide(['updated_at','email_verified'])
        ]);
    }
}
