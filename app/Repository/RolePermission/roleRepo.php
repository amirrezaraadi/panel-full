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
            'guard_name' => 'api' ,
            'name' => $role['name']
        ]);
    }
}
