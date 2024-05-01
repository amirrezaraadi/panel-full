<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Manager\UserRequest;
use App\Models\User;
use App\Repository\Manager\userRepo;
use App\Service\JsonResponse;

class UserContoller extends Controller
{
    public function __construct(public userRepo $userRepo)
    {
    }

    public function index()
    {
        $users = $this->userRepo
            ->searchName(request('name'))
            ->searchEmail(request('email'))
//            ->searchPhone(request('name'))
//            ->searchName(request('name'))
        ;
        return $users->paginateUser();
    }

    public function store(RegisterRequest $request): \Illuminate\Http\JsonResponse
    {
        $this->userRepo->create($request->only('name', 'email', 'password'));
        return JsonResponse::SuccessResponse('success create user', 'success');
    }

    public function show($id)
    {
        return $this->userRepo->getFindId($id);
    }

    public function update(UserRequest $request, $id): \Illuminate\Http\JsonResponse
    {
        $this->userRepo->update($request->only('name', 'email', 'password'), $id);
        return JsonResponse::SuccessResponse('success create user', 'success');
    }

    public function destroy($id): \Illuminate\Http\JsonResponse
    {
        $delete = $this->userRepo->delete($id);
        if ($delete === 0) return JsonResponse::NotFoundResponse('not found user', 'error');
        return JsonResponse::SuccessResponse('success create user', 'success');
    }

    public function ban($id)
    {
        $this->userRepo->status($id, User::STATUS_USER_BAN);
        return JsonResponse::SuccessResponse('change status successfully', 'success');
    }

    public function success($id): \Illuminate\Http\JsonResponse
    {
        $this->userRepo->status($id, User::STATUS_USER_SUCCESS);
        return JsonResponse::SuccessResponse('change status successfully', 'success');
    }

    public function reject($id): \Illuminate\Http\JsonResponse
    {
        $this->userRepo->status($id, User::STATUS_USER_REJECT);
        return JsonResponse::SuccessResponse('change status successfully', 'success');
    }

    public function pending($id): \Illuminate\Http\JsonResponse
    {
        $this->userRepo->status($id, User::STATUS_USER_PENDING);
        return JsonResponse::SuccessResponse('change status successfully', 'success');
    }

    public function active($id): \Illuminate\Http\JsonResponse
    {
        $user = $this->userRepo->getFindId($id);
        $user->markEmailAsVerified();
        $this->userRepo->status($id, User::STATUS_USER_ACTIVE);
        return JsonResponse::SuccessResponse('change status successfully', 'success');
    }
}
