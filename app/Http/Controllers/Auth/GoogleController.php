<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Repository\Manager\userRepo;
use App\Service\Token;
use Carbon\Carbon;
use http\Client\Curl\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function __construct(public userRepo $userRepo)
    {
    }

    public function google()
    {
        return Socialite::driver('google')->redirect();
    }

    public function google_callback()
    {
        try {
            $google = Socialite::driver('google')->user();
            $userFind = $this->userRepo->getGoogleId($google->email);
            if ($userFind) {
                $token = Token::generate($userFind);
                return response()->json(['token' => $token], 200);
            }
            $user = \App\Models\User::query()->create([
                'name' => $google->name,
                'email' => $google->email,
                'email_verified' => Carbon::now(),
            ]);
            $token = Token::generate($user);
            return response()->json(['token' => $token], 200);
        } catch (\Exception $exception) {
            return $exception ;
        }
    }

}
