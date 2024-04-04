<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Repository\Manager\userRepo;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    public function store(LoginRequest $request, userRepo $userRepo): \Illuminate\Http\JsonResponse
    {
        $token = $userRepo->userLogin($request->only(['email', 'password']));
        return response()->json(['token' => $token, 'status' => 'success'], 200);
    }

    public function destroy(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['status' => 'success'], 200);
    }
}
