<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'application-setting',      //1
            'permission-list',          // 2
            'permission-create',        // 3
            'permission-edit',          // 4
            'permission-delete',        // 5
            'role-list',                // 6
            'role-create',              // 7
            'role-edit',                // 8
            'role-delete',              // 9
            'user-list',                // 10
            'user-create',              // 11
            'user-edit',                // 12
            'user-delete',              // 13
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
