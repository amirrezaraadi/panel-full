<?php

namespace App\Repository\RolePermission;

use App\Http\Controllers\RolePermission\PermissionController;
use App\Models\RolePermission\Role;
use App\Models\User;
use Exception;
use Spatie\Permission\Models\Permission;

class roleRepo
{
    private $role;

    public function __construct()
    {
        $this->role = Role::query();
    }

    public function index()
    {
        return $this->role->get();
    }

    public function createRole($role)
    {

        return $this->role->create([
            'name' => $role['name'],
            'guard_name' => 'api'
        ]);
    }

    public function getFindID($role)
    {
        return Role::query()->findOrFail($role);
    }

    public function deleteRole($roleId)
    {
        return Role::query()->where('id', $roleId)->delete();
    }

    public function updateRole($data, $roleId)
    {
        return Role::query()->where('id', $roleId->id)->update([
            'name' => $data['name'] ?? $roleId->name
        ]);
    }

    public function getFindName($name)
    {
        return Role::query()->where('name', $name)->first();
    }

    public function syncMultiPermissionToRole($role, $permissionId)
    {
        $role = $this->getFindName($role);
        $string = str_replace(['[', ']'], '', $permissionId);
        $permission_explode = explode(',', $string);
        $permissions = Permission::query()->whereIn('id', $permission_explode)->get()->pluck('id')->toArray();
        $role->syncPermissions($permissions);
        return true;
    }

    public function syncRoleBeUser($roles, $userId)
    {
        $string = str_replace(['[', ']'], '', $roles);
        $role_explode = explode(',', $string);
        $role = Role::query()->whereIn('id', $role_explode)->get()->pluck('name')->toArray();
        $user = User::query()->where('id', $userId)->first();

        $user->assignRole($role);
        return true;

    }


}
