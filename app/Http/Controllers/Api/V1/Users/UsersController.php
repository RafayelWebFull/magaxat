<?php

namespace App\Http\Controllers\Api\V1\Users;

use App\Http\Controllers\Api\Traits\ApiResponser;
use App\Http\Controllers\Controller;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    use ApiResponser;

    public function index():JsonResponse
    {
        $hidesArray = [
            'created_at',
            'updated_at',
            'type',
            'organisation_description',
            'email_verified'
        ];

        return $this->successResponse([
            'data' => auth()->user()->isAdmin()
                ? UserResource::collection(User::all()->load(['country']))->hide($hidesArray)
                : UserResource::collection(
                    User::where('type','!=','admin')->get()->load(['country'])
                )->hide($hidesArray)
        ]);
    }

    public function show(User $user):JsonResponse
    {
        return $this->successResponse([
            'data' => !$user->isAdmin()
                ? UserResource::make($user->load(['country']))->hide(['updated_at','email_verified'])
                : []
        ]);
    }

    public function destroy(User $user)
    {
        $this->authorize('canDestroy',auth()->user());
        $user->deleteOrFail();
        return $this->successResponse([
            'message' => __("AuthApi.msg.removed")
        ]);
    }

    public function changeStatus(Request $request,User $user)
    {
        $this->authorize('canChangeStatus',auth()->user());
        $user->updateOrFail([
            'status' => $request->status
        ]);
        return $this->successResponse([
            'data' => UserResource::make($user->load(['country']))->hide(['updated_at','email_verified']),
            'message' => __("AuthApi.msg.updated")
        ]);
    }
    public function getUsersList() {
        $users = User::query()->orderBy('created_at', 'DESC')->limit(10)->get();
        return $users;
    }
}
