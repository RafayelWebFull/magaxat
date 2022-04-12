<?php

namespace App\Http\Controllers\Api\V1\Profile;

use App\Http\Controllers\Api\Traits\ApiResponser;
use App\Http\Controllers\Controller;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    use ApiResponser;

    public function me()
    {
        return $this->successResponse([
            'data' => UserResource::make(auth()->user()->load(['country','interesting_type']))
                ->hide(['updated_at','type','email_verified'])
        ]);
    }

    public function update(Request $request)
    {
        $authUser = User::findOrFail(auth()->user()->id);
        // TODO cleanup code , make request
        $authUser->update($request->all());
        return $this->successResponse([
            'message' => __('AuthApi.msg.updated'),
            'data' => UserResource::make($authUser)->hide(['updated_at','type','email_verified'])
        ]);
    }
}
