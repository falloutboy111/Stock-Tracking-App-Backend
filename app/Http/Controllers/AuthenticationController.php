<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Resources\LoginResource;
use Illuminate\Http\Request;

class AuthenticationController extends Controller
{
    public function login(LoginRequest $request)
    {
        return response(new LoginResource($request->user_obj()), 200);
    }
}
