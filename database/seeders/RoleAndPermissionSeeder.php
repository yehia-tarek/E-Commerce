<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->truncateTables();
        $this->createPermissions();
        $this->createRoles();
    }

    public function truncateTables()
    {
        $tables = [
            'permissions',
            'roles',
        ];
        foreach ($tables as $table) {
            DB::table($table)->truncate();
        }
    }

    public function createPermissions()
    {
        $permissions = [
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'permission-list',
            'permission-create',
            'permission-edit',
            'permission-delete',
            'admin-list',
            'admin-create',
            'admin-edit',
            'admin-delete',
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
        ];
        foreach ($permissions as $permission) {
            Permission::create(['guard_name' => 'admin', 'name' => $permission]);
        }
    }

    public function createRoles()
    {
        Role::create(['guard_name' => 'admin', 'name' => 'Super Admin']);
    }
}
