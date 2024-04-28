<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Repository\Manager\userRepo;
use App\Service\JsonResponse;
use Illuminate\Http\Request;

class AuthenticatedSessionController extends Controller
{
    public function store(LoginRequest $request, userRepo $userRepo): \Illuminate\Http\JsonResponse
    {
        $token = $userRepo->userLogin($request->only(['email', 'password']));
        if($token === false)
            return JsonResponse::internalSererError('Your password or email is incorrect' , 'error');
        return response()->json(['token' => $token, 'status' => 'success'], 200);
    }

    public function destroy(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['status' => 'success'], 200);
    }
}
