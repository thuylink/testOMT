<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            RoleSeeder::class,
            PermissionSeeder::class,
        ]);

        // Tạo vai trò super-admin nếu chưa có
        $superAdminRole = Role::firstOrCreate(['name' => 'super-admin']);

        // Tạo người dùng super admin
        $superAdmin = User::create([
            'name'     => 'Super Admin',
            'email'    => 'superadmin@example.com',
            'password' => Hash::make('superadmin'),
        ]);

        // Gán vai trò super-admin cho người dùng vừa tạo
        $superAdmin->roles()->attach($superAdminRole->id);

    }
}
