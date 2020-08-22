<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class LogoutController extends Controller
{
    public function logout()
    {
        auth()->user()->update([
            'api_token' => null
        ]);

        return response([
            'message' => 'خروج با موفقیت انجام شد.',
            'data' => new User(auth()->user()),
            'status' => Response::HTTP_OK
        ], Response::HTTP_OK);
    }
}
