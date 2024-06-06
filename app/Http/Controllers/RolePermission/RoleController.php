<?php

namespace App\Http\Controllers\RolePermission;

use App\Http\Controllers\Controller;
use App\Http\Requests\RolePermission\RoleRequest;
use App\Models\RolePermission\Role;
use App\Repository\RolePermission\roleRepo;
use App\Service\JsonResponse;
use Illuminate\Http\Request;
use Psy\Util\Json;

class RoleController extends Controller
{
    public function __construct(public roleRepo $roleRepo)
    {
    }

    public function index()
    {
        return $this->roleRepo->index();
    }

    public function store(RoleRequest $request): \Illuminate\Http\JsonResponse
    {
        $this->roleRepo->createRole($request->only('name'));
        return JsonResponse::SuccessResponse('create role', 'success');
    }

    public function show($role)
    {
        return $this->roleRepo->getFindID($role);
    }

    public function update(RoleRequest $request , $role): \Illuminate\Http\JsonResponse
    {
        $roleId = $this->roleRepo->getFindID($role);
        $this->roleRepo->updateRole($request->only('name') , $roleId);
        return JsonResponse::SuccessResponse('update role', 'success');
    }

    public function destroy($role)
    {
        $roleId = $this->roleRepo->getFindID($role);
        $this->roleRepo->deleteRole( $roleId->id);
        return JsonResponse::SuccessResponse('delete role', 'success');
    }

    public function role_permission(Request $request)
    {
        $this->roleRepo->syncMultiPermissionToRole($request->role , $request->permissions );
        return JsonResponse::SuccessResponse('sync role and permission ', 'success');

    }

    public function role_user(Request $request)
    {
        $this->roleRepo->syncRoleBeUser($request->roles , $request->userId);
        return JsonResponse::SuccessResponse('sync role and permission ', 'success');

    }
}
