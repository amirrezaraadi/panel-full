<?php

namespace App\Repository\RolePermission;

use App\Models\RolePermission\Role;

class roleRepo
{
    private $role ;
    public function __construct()
    {
        $this->role = Role::query() ;
    }

    public function index()
    {
        return $this->role->get();
    }

    public function createRole($role)
    {
        return $this->role->create([
            'name' => $role['name']
        ]);
    }

    public function getFindID($role)
    {
        return Role::query()->findOrFail($role);
    }

    public function deleteRole($roleId)
    {
        return Role::query()->where('id' , $roleId->id)->delete();
    }

    public function updateRole( $data, $roleId)
    {
        return Role::query()->where('id' , $roleId->id)->update([
            'name' => $data['name'] ?? $roleId->name
        ]);
    }
}
