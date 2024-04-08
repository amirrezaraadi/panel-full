<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ChangePasswordRequest;
use App\Models\User;
use App\Repository\Manager\userRepo;
use App\Service\JsonResponse;
use Illuminate\Support\Facades\Hash;

class NewPasswordController extends Controller
{
    public function store(ChangePasswordRequest $request , userRepo $userRepo)
    {
        $request->validated();
        $user = User::query()->where('id' , auth()->id())->first();
        $user->update(['password' => Hash::make($request->get('password'))]);
        $user->successChangePassword() ;
        return JsonResponse::SuccessResponse('change password' , 'success');
    }
}
