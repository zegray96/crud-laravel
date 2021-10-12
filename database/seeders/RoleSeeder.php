<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Role::create(['name' => 'Admin']);
        $auxiliar = Role::create(['name' => 'Auxiliar']);
        // Articles
        $permission = Permission::create(['name' => 'articles.list'])->syncRoles([$admin, $auxiliar]);
        $permission = Permission::create(['name' => 'articles.create'])->syncRoles([$admin, $auxiliar]);
        $permission = Permission::create(['name' => 'articles.edit'])->syncRoles([$admin, $auxiliar]);
        $permission = Permission::create(['name' => 'articles.delete'])->syncRoles([$admin, $auxiliar]);
        // Users
        $permission = Permission::create(['name' => 'users.list'])->syncRoles([$admin]);
        $permission = Permission::create(['name' => 'users.create'])->syncRoles([$admin]);
        $permission = Permission::create(['name' => 'users.edit'])->syncRoles([$admin]);
        $permission = Permission::create(['name' => 'users.delete'])->syncRoles([$admin]);
    }
}