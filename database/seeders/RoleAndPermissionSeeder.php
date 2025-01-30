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
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $tables = [
            'permissions',
            'roles',
        ];
        foreach ($tables as $table) {
            DB::table($table)->truncate();
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

    public function createPermissions()
    {
        $permissions = [
            'role' => [
                'role-list',
                'role-create',
                'role-edit',
                'role-delete',
            ],
            'admin' => [
                'admin-list',
                'admin-create',
                'admin-edit',
                'admin-delete',
            ],
            'user' => [
                'user-list',
                'user-create',
                'user-edit',
                'user-delete',
            ],
        ];
        foreach ($permissions as $group => $groupPermissions) {
            foreach ($groupPermissions as $permission) {
                Permission::create(['guard_name' => 'admin', 'name' => $permission, 'group_name' => $group]);
            }
        }
    }

    public function createRoles()
    {
        Role::create(['guard_name' => 'admin', 'name' => 'Super Admin']);
    }
}
