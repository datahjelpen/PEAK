<?php

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()['cache']->forget('spatie.permission.cache');

        // create permissions
        $view_users   = Permission::create(['name' => 'view users']);
        $create_users = Permission::create(['name' => 'create users']);
        $update_users = Permission::create(['name' => 'update users']);
        $delete_users = Permission::create(['name' => 'delete users']);

        $view_item_types   = Permission::create(['name' => 'view item_types']);
        $create_item_types = Permission::create(['name' => 'create item_types']);
        $update_item_types = Permission::create(['name' => 'update item_types']);
        $delete_item_types = Permission::create(['name' => 'delete item_types']);

        $view_taxonomies   = Permission::create(['name' => 'view taxonomies']);
        $create_taxonomies = Permission::create(['name' => 'create taxonomies']);
        $update_taxonomies = Permission::create(['name' => 'update taxonomies']);
        $delete_taxonomies = Permission::create(['name' => 'delete taxonomies']);

        $view_terms   = Permission::create(['name' => 'view terms']);
        $create_terms = Permission::create(['name' => 'create terms']);
        $update_terms = Permission::create(['name' => 'update terms']);
        $delete_terms = Permission::create(['name' => 'delete terms']);

        $view_statuses   = Permission::create(['name' => 'view statuses']);
        $create_statuses = Permission::create(['name' => 'create statuses']);
        $update_statuses = Permission::create(['name' => 'update statuses']);
        $delete_statuses = Permission::create(['name' => 'delete statuses']);

        $view_items   = Permission::create(['name' => 'view items']);
        $create_items = Permission::create(['name' => 'create items']);
        $update_items = Permission::create(['name' => 'update items']);
        $delete_items = Permission::create(['name' => 'delete items']);

        // create roles and assign existing permissions
        $role = new Role;
        $role->name = 'superadmin';
        $role->save();

        $role->givePermissionTo($view_users);
        $role->givePermissionTo($create_users);
        $role->givePermissionTo($update_users);
        $role->givePermissionTo($delete_users);

        $role->givePermissionTo($view_item_types);
        $role->givePermissionTo($create_item_types);
        $role->givePermissionTo($update_item_types);
        $role->givePermissionTo($delete_item_types);

        $role->givePermissionTo($view_taxonomies);
        $role->givePermissionTo($create_taxonomies);
        $role->givePermissionTo($update_taxonomies);
        $role->givePermissionTo($delete_taxonomies);

        $role->givePermissionTo($view_terms);
        $role->givePermissionTo($create_terms);
        $role->givePermissionTo($update_terms);
        $role->givePermissionTo($delete_terms);

        $role->givePermissionTo($view_statuses);
        $role->givePermissionTo($create_statuses);
        $role->givePermissionTo($update_statuses);
        $role->givePermissionTo($delete_statuses);

        $role->givePermissionTo($view_items);
        $role->givePermissionTo($create_items);
        $role->givePermissionTo($update_items);
        $role->givePermissionTo($delete_items);

        $role->save();

        $role = new Role;
        $role->name = 'admin';
        $role->save();

        $role->givePermissionTo($view_terms);
        $role->givePermissionTo($create_terms);
        $role->givePermissionTo($update_terms);
        $role->givePermissionTo($delete_terms);
        $role->save();
    }
}
