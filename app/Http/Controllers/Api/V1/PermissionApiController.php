<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class PermissionApiController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function permissionsByRole($id)
    {
        $rolePermissions = Permission::join(
            "role_has_permissions",
            "role_has_permissions.permission_id","=","permissions.id"
        )->where("role_has_permissions.role_id", $id)->get();
        return response()->json($rolePermissions);
    }

}
