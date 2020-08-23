<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\RegisterUser;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\v1\User as UserResource;

class RegisterController extends Controller
{
    public function register(RegisterUser $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = auth()->guard('api')->login($user);

        return response([
            'message' => 'ثبت نام با موفقیت انجام شد.',
            'data' => [
                'token' => $token,
                'token_type' => 'Bearer',
            ],
            'status' => Response::HTTP_OK
        ], Response::HTTP_OK);


    }
}
