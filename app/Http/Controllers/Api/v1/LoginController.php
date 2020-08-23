<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\LoginUser;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\v1\User as UserResource;

class LoginController extends Controller
{
    public function login(LoginUser $request)
    {
        if (!$token = \auth()->guard('api')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return response(['message' => 'اطلاعات صحیح نیست',
                    'data' => [],
                    'status' => Response::HTTP_UNAUTHORIZED]
                , Response::HTTP_UNAUTHORIZED);
        } else {
            return response([
                'message' => 'ورود با موفقیت انجام شد.',
                'data' => [
                    'token' => $token,
                    'token_type' => 'Bearer',
                ],
                'status' => Response::HTTP_OK
            ], Response::HTTP_OK);
        }
    }
}
