<?php

use Illuminate\Database\Seeder;

// TODO: Convert this to read in an xml file.
class RolesPermissionsTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     * 
     * The are read in from a file.
     *
     * @return void
     */
    public function run() {
        
        // All admin permissions
        DB::table('roles_permissions')->insert([
            'role_id' => App\Role::where('name', 'admin')->first()->id,
            'permission_id' => App\Permission::where('name', 'create_user')->first()->id,
        ]);
        DB::table('roles_permissions')->insert([
            'role_id' => App\Role::where('name', 'admin')->first()->id,
            'permission_id' => App\Permission::where('name', 'edit_user')->first()->id,
        ]);
        DB::table('roles_permissions')->insert([
            'role_id' => App\Role::where('name', 'admin')->first()->id,
            'permission_id' => App\Permission::where('name', 'delete_user')->first()->id,
        ]);
        DB::table('roles_permissions')->insert([
            'role_id' => App\Role::where('name', 'admin')->first()->id,
            'permission_id' => App\Permission::where('name', 'create_module')->first()->id,
        ]);
        DB::table('roles_permissions')->insert([
            'role_id' => App\Role::where('name', 'admin')->first()->id,
            'permission_id' => App\Permission::where('name', 'edit_module')->first()->id,
        ]);
        DB::table('roles_permissions')->insert([
            'role_id' => App\Role::where('name', 'admin')->first()->id,
            'permission_id' => App\Permission::where('name', 'delete_module')->first()->id,
        ]);
        DB::table('roles_permissions')->insert([
            'role_id' => App\Role::where('name', 'admin')->first()->id,
            'permission_id' => App\Permission::where('name', 'create_coursework')->first()->id,
        ]);
        DB::table('roles_permissions')->insert([
            'role_id' => App\Role::where('name', 'admin')->first()->id,
            'permission_id' => App\Permission::where('name', 'edit_coursework')->first()->id,
        ]);
        DB::table('roles_permissions')->insert([
            'role_id' => App\Role::where('name', 'admin')->first()->id,
            'permission_id' => App\Permission::where('name', 'delete_coursework')->first()->id,
        ]);
        DB::table('roles_permissions')->insert([
            'role_id' => App\Role::where('name', 'admin')->first()->id,
            'permission_id' => App\Permission::where('name', 'mark_submission')->first()->id,
        ]);

        // All student permissions
        DB::table('roles_permissions')->insert([
            'role_id' => App\Role::where('name', 'admin')->first()->id,
            'permission_id' => App\Permission::where('name', 'create_submission')->first()->id,
        ]);

        // All professor permissions
        DB::table('roles_permissions')->insert([
            'role_id' => App\Role::where('name', 'admin')->first()->id,
            'permission_id' => App\Permission::where('name', 'create_module')->first()->id,
        ]);
        DB::table('roles_permissions')->insert([
            'role_id' => App\Role::where('name', 'admin')->first()->id,
            'permission_id' => App\Permission::where('name', 'edit_module')->first()->id,
        ]);
        DB::table('roles_permissions')->insert([
            'role_id' => App\Role::where('name', 'admin')->first()->id,
            'permission_id' => App\Permission::where('name', 'delete_module')->first()->id,
        ]);
        DB::table('roles_permissions')->insert([
            'role_id' => App\Role::where('name', 'admin')->first()->id,
            'permission_id' => App\Permission::where('name', 'create_coursework')->first()->id,
        ]);
        DB::table('roles_permissions')->insert([
            'role_id' => App\Role::where('name', 'admin')->first()->id,
            'permission_id' => App\Permission::where('name', 'edit_coursework')->first()->id,
        ]);
        DB::table('roles_permissions')->insert([
            'role_id' => App\Role::where('name', 'admin')->first()->id,
            'permission_id' => App\Permission::where('name', 'delete_coursework')->first()->id,
        ]);
        DB::table('roles_permissions')->insert([
            'role_id' => App\Role::where('name', 'admin')->first()->id,
            'permission_id' => App\Permission::where('name', 'mark_submission')->first()->id,
        ]);

        // All assessor permissions
        DB::table('roles_permissions')->insert([
            'role_id' => App\Role::where('name', 'admin')->first()->id,
            'permission_id' => App\Permission::where('name', 'mark_submission')->first()->id,
        ]);
    }
}