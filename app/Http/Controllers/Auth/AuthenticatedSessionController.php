<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Repository\Manager\userRepo;
use App\Service\JsonResponse;
use App\Service\Token;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class AuthenticatedSessionController extends Controller
{
    public function __construct(public userRepo $userRepo)
    {
    }

    public function store(LoginRequest $request, userRepo $userRepo): \Illuminate\Http\JsonResponse
    {
        if ($request->hasHeader('X-GOOGLE-AUTH')) {
            try {
                $userFind = $this->userRepo->getFindEmail($request->email);
                if (!is_null($userFind)) {
                    $token = Token::generate($userFind);
                    return response()->json(['token' => $token  , 'status' => 'success'], 200);
                }
                $user = \App\Models\User::query()->create([
                    'name' => $request->name ?? Str::before($request->email, '@'),
                    'email' => $request->email,
                    'email_verified_at' => Carbon::now(),
                ]);
                $token = Token::generate($user);
                return response()->json(['token' => $token , 'status' => 'success'], 200);
            } catch (Exception $exception) {
                return $exception;
            }
        }


        $token = $userRepo->userLogin($request->only(['email', 'password']));
        if ($token === false)
            return JsonResponse::internalSererError('Your password or email is incorrect', 'error');
        return response()->json(['token' => $token, 'status' => 'success'], 200);
    }

    public function destroy(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['status' => 'success'], 200);
    }
}
