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
        $validatedData = $request->validated();

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'api_token' => Hash::make(Str::random(100)),
            'password' => Hash::make($validatedData['password']),
        ]);

        return response([
            'message' => 'ثبت نام با موفقیت انجام شد.',
            'data' => new UserResource($user),
            'status' => Response::HTTP_OK
        ], Response::HTTP_OK);


    }
}
