<?php

use Illuminate\Database\Seeder;

class GlobalRolesPermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // All admin permissions
        DB::table('global_roles_permissions')->insert([
            'global_role_id' => App\GlobalRole::where('name', 'admin')->first()->id,
            'permission_id' => App\Permission::where('name', 'create_user')->first()->id,
        ]);
        DB::table('global_roles_permissions')->insert([
            'global_role_id' => App\GlobalRole::where('name', 'admin')->first()->id,
            'permission_id' => App\Permission::where('name', 'edit_user')->first()->id,
        ]);
        DB::table('global_roles_permissions')->insert([
            'global_role_id' => App\GlobalRole::where('name', 'admin')->first()->id,
            'permission_id' => App\Permission::where('name', 'delete_user')->first()->id,
        ]);
        DB::table('global_roles_permissions')->insert([
            'global_role_id' => App\GlobalRole::where('name', 'admin')->first()->id,
            'permission_id' => App\Permission::where('name', 'create_module')->first()->id,
        ]);
        DB::table('global_roles_permissions')->insert([
            'global_role_id' => App\GlobalRole::where('name', 'admin')->first()->id,
            'permission_id' => App\Permission::where('name', 'edit_module')->first()->id,
        ]);
        DB::table('global_roles_permissions')->insert([
            'global_role_id' => App\GlobalRole::where('name', 'admin')->first()->id,
            'permission_id' => App\Permission::where('name', 'delete_module')->first()->id,
        ]);
    }
}
