<?php

namespace App\Http\Controllers\RolePermission;

use App\Http\Controllers\Controller;
use App\Http\Requests\RolePermission\PermissionRequest;
use App\Models\RolePermission\Permission;
use App\Repository\RolePermission\roleRepo;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function __construct(public roleRepo $roleRepo){}

    public function index()
    {
        return $this->roleRepo->index();
    }


    public function store(PermissionRequest $request)
    {
        //
    }


    public function show(Permission $permission)
    {
        //
    }


    public function update(Request $request, Permission $permission)
    {
        //
    }


    public function destroy(Permission $permission)
    {
        //
    }
}
