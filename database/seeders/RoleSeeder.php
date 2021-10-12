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
        $permission = Permission::create(['name' => 'articles.list', 'description' => 'Ver listado de articulos'])->syncRoles([$admin, $auxiliar]);
        $permission = Permission::create(['name' => 'articles.create', 'description' => 'Crear articulos'])->syncRoles([$admin, $auxiliar]);
        $permission = Permission::create(['name' => 'articles.edit', 'description' => 'Editar articulos'])->syncRoles([$admin, $auxiliar]);
        $permission = Permission::create(['name' => 'articles.delete', 'description' => 'Eliminar articulos'])->syncRoles([$admin, $auxiliar]);
        // Users
        $permission = Permission::create(['name' => 'users.list', 'description' => 'Ver listado de usuarios'])->syncRoles([$admin]);
        $permission = Permission::create(['name' => 'users.create', 'description' => 'Crear usuarios'])->syncRoles([$admin]);
        $permission = Permission::create(['name' => 'users.edit', 'description' => 'Editar usuarios'])->syncRoles([$admin]);
        $permission = Permission::create(['name' => 'users.delete', 'description' => 'Eliminar usuarios'])->syncRoles([$admin]);
    }
}