<?php

namespace App\Repository\RolePermission;

use App\Models\RolePermission\Permission;

class permissionRepo
{
    public function index()
    {
        return Permission::query()->select('name')->get();
    }

    public function create($data)
    {
        return Permission::query()->create([
            'name' => $data['name'],
            'guard_name' => 'api'
        ]);
    }

    public function getFindId($id)
    {
        return Permission::query()->findOrFail($id);
    }

    public function delete($id)
    {
        return Permission::query()->where('id', $id)->delete();
    }

    public function update($data, $id)
    {
        return Permission::query()->where('id' , $id->id)->update([
            'name' => $data['name'] ?? $id->name
        ]);
    }
}
