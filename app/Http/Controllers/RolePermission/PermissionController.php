<?php

namespace App\Http\Controllers\RolePermission;

use App\Http\Controllers\Controller;
use App\Http\Requests\RolePermission\PermissionRequest;
use App\Models\RolePermission\Permission;
use App\Repository\RolePermission\permissionRepo;
use App\Repository\RolePermission\roleRepo;
use App\Service\JsonResponse;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function __construct(public  permissionRepo $permissionRepo){}

    public function index()
    {
        return $this->permissionRepo->index();
    }


    public function store(PermissionRequest $request): \Illuminate\Http\JsonResponse
    {
        $this->permissionRepo->create($request->only('name'));
        return response()->json(['message' => 'create permission ' , 'status' => 'success'],200);
    }


    public function show($permission)
    {
        return $this->permissionRepo->getFindId($permission);
    }


    public function update(PermissionRequest $request, $permission)
    {
        $permissionId = $this->permissionRepo->getFindId($permission);
        $this->permissionRepo->update($request->only('name') , $permissionId);
        return response()->json(['message' => 'update permission ' , 'status' => 'success'],200);
    }


    public function destroy($permission)
    {
        $permissionId = $this->permissionRepo->getFindId($permission);
        $this->permissionRepo->delete($permissionId->id);
        return response()->json(['message' => 'delete permission ' , 'status' => 'success'],200);
    }

    public function permission_user(Request $request)
    {
        $this->permissionRepo->syncPermissionBeUser($request->permissions , $request->userId);
        return JsonResponse::SuccessResponse('sync user and permission ', 'success');
    }
}
