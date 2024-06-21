<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;

class RolesPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Tạo vai trò Super Admin
        $superAdminRole = Role::create(['name' => 'superadmin']);

        // Tạo tài khoản Super Admin
        $superAdmin = User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@example.com',
            'password' => Hash::make('supersecurepassword'),
            'usertype' => 3 // Đặt giá trị số cho usertype
        ]);

        // Gán vai trò Super Admin cho tài khoản Super Admin
        $superAdmin->roles()->attach($superAdminRole->id);

        // Tạo các quyền hạn
        $permissions = ['create-user', 'edit-user', 'delete-user', 'view-user'];

        foreach ($permissions as $permission) {
            $perm = Permission::create(['name' => $permission]);
            // Gán tất cả quyền hạn cho Super Admin
            $superAdminRole->permissions()->attach($perm->id);
        }
    }
}
