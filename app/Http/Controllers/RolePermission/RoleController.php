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

    public function store(RoleRequest $request)
    {
        $this->roleRepo->createRole($request->all());
        return JsonResponse::SuccessResponse('create role', 'success');
    }


}
