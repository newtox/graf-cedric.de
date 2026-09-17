<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{

    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $viewCompanies = Permission::create(['name' => 'view companies']);
        $createCompanies = Permission::create(['name' => 'create companies']);
        $editCompanies = Permission::create(['name' => 'edit companies']);
        $deleteCompanies = Permission::create(['name' => 'delete companies']);

        $viewGames = Permission::create(['name' => 'view games']);
        $createGames = Permission::create(['name' => 'create games']);
        $editGames = Permission::create(['name' => 'edit games']);
        $deleteGames = Permission::create(['name' => 'delete games']);

        $viewTags = Permission::create(['name' => 'view tags']);
        $createTags = Permission::create(['name' => 'create tags']);
        $editTags = Permission::create(['name' => 'edit tags']);
        $deleteTags = Permission::create(['name' => 'delete tags']);

        $viewUsers = Permission::create(['name' => 'view users']);
        $createUsers = Permission::create(['name' => 'create users']);
        $editUsers = Permission::create(['name' => 'edit users']);
        $deleteUsers = Permission::create(['name' => 'delete users']);

        $admin = Role::create(['name' => 'Admin']);
        $editor = Role::create(['name' => 'Editor']);

        $admin->givePermissionTo([
            $viewCompanies,
            $createCompanies,
            $editCompanies,
            $deleteCompanies,
            $viewGames,
            $createGames,
            $editGames,
            $deleteGames,
            $viewTags,
            $createTags,
            $editTags,
            $deleteTags,
            $viewUsers,
            $createUsers,
            $editUsers,
            $deleteUsers
        ]);

        $editor->givePermissionTo([
            $viewCompanies,
            $createCompanies,
            $editCompanies,
            $viewGames,
            $createGames,
            $editGames,
            $viewTags,
            $createTags,
            $editTags
        ]);
    }
}
