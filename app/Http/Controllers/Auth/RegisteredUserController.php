<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Repository\userRepo;

class RegisteredUserController extends Controller
{

    public function store(RegisterRequest $request , userRepo $userRepo)
    {
        $token  = $userRepo->registerUser($request->only(['email' , 'name' , 'password']));
        return response()->json(['token' => $token , 'status' => 'success'] ,200);
    }
}
