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
        $validateData = $request->validated();

        $user = User::where('email', $validateData['email'])->first();
        if (Hash::check($validateData['password'], $user->password)) {
            $user->update([
                'api_token' => Hash::make(Str::random(100)),
            ]);
            return response([
                'message' => 'ورود با موفقیت انجام شد.',
                'data' => new UserResource($user),
                'status' => Response::HTTP_OK
            ], Response::HTTP_OK);

        } else {
            return response(['message' => 'اطلاعات صحیح نیست',
                    'data' => [],
                    'status' => Response::HTTP_UNAUTHORIZED]
                , Response::HTTP_UNAUTHORIZED);
        }

        /*if (Auth::attempt($validateData)) {

            auth()->user()->update([
                'api_token' => Hash::make(Str::random(100)),
            ]);

            return response([
                'message' => 'ورود با موفقیت انجام شد.',
                'data' => new UserResource(auth()->user()),
                'status' => Response::HTTP_OK
            ], Response::HTTP_OK);
        } else {
            return response([
                'message' => 'اطلاعات صحیح نیست',
                'data' => [],
                'status' => Response::HTTP_UNAUTHORIZED
            ], Response::HTTP_UNAUTHORIZED);
        }*/
    }
}
