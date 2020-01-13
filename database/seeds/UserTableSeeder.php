<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin_id = 1;
        $admin_has_permission = [1,2,3,4,5,6,7,8,9,10,11,12,13];
        $admin = Role::findOrFail($admin_id);
        $admin->syncPermissions($admin_has_permission);
        $admin_user = [
            'name' => 'Administration',
            'username' => 'admin',
            'phone' => '+6282270001111',
            'email' => 'admin@skeleton.id',
            'email_verified_at' => now(),
            'password' => Hash::make('secret'),
            'status' => 'ACTIVE'
        ];
        $admin = User::create($admin_user);
        $admin->assignRole($admin_id);

        $staff_id = 2;
        $staff_user = [
            'name' => 'Staff',
            'username' => 'staff',
            'phone' => '+6282270003333',
            'email' => 'staff@skeleton.id',
            'email_verified_at' => now(),
            'password' => Hash::make('secret'),
            'status' => 'ACTIVE'
        ];
        $staff = User::create($staff_user);
        $staff->assignRole($staff_id);
    }
}
