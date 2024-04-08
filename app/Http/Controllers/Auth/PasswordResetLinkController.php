<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Repository\Manager\userRepo;
use App\Service\JsonResponse;
use App\Service\VerifyCodeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;

class PasswordResetLinkController extends Controller
{
    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request  , userRepo $userRepo): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);
        $user = $userRepo->getFindEmail($request->only('email'));
        VerifyCodeService::delete($user->id);
        if(is_null($user))
            return \App\Service\JsonResponse::NotFoundResponse('not found user' , 'error');
        $user->sendEmailForgetPassword();
        return JsonResponse::SuccessFindid( $user->email );
    }

    public function checkPassword(Request $request , $email)
    {
        $user = resolve(userRepo::class)->getFindEmail($email);
        if ($user == null || !VerifyCodeService::check( $user->id , $request->verify_code)) {
            return JsonResponse::NotFoundResponse('not found code' , 'error');
        }
        return JsonResponse::SuccessResponse('You have entered the site correctly' , 'success');
    }

// link
//    public function store(Request $request): \Illuminate\Http\RedirectResponse
//    {
//        $request->validate([
//            'email' => ['required', 'email'],
//        ]);
//        $status = Password::sendResetLink(
//            $request->only('email')
//        );
//
//        return $status == Password::RESET_LINK_SENT
//            ? back()->with('status', __($status))
//            : back()->withInput($request->only('email'))
//                ->withErrors(['email' => __($status)]);
//    }
}
