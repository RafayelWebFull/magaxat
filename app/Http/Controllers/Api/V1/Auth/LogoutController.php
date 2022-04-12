<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Api\Traits\ApiResponser;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    use ApiResponser;

    public function logout(Request $request)
    {
        if ($token = $request->user()->currentAccessToken()){
            $token->delete();
            return $this->successResponse([
                'message' => __("AuthApi.msg.loggedOut")
            ]);
        }
        return $this->errorResponse();
    }
}
