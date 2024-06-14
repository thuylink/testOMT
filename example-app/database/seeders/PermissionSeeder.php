<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            ['name' => 'manage-post'],
            ['name' => 'read-post'],
            ['name' => 'manage-role-permission'],
            ['name' => 'read-role-permission'],
            ['name' => 'manage-user'],
            ['name' => 'read-user'],
        ];

        foreach ($permissions as $permission) {
            Permission::create($permission);
        }
    }
}
