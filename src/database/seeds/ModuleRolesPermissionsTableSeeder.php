<?php

use Illuminate\Database\Seeder;

class ModuleRolesPermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // All student permissions
        DB::table('module_roles_permissions')->insert([
            'module_roles_id' => App\ModuleRole::where('name', 'student')->first()->id,
            'permission_id' => App\Permission::where('name', 'create_submission')->first()->id,
        ]);

        // All assessor permissions
        DB::table('module_roles_permissions')->insert([
            'module_roles_id' => App\ModuleRole::where('name', 'assessor')->first()->id,
            'permission_id' => App\Permission::where('name', 'mark_submission')->first()->id,
        ]);

        // All professor permissions
        DB::table('module_roles_permissions')->insert([
            'module_roles_id' => App\ModuleRole::where('name', 'professor')->first()->id,
            'permission_id' => App\Permission::where('name', 'edit_module')->first()->id,
        ]);
        DB::table('module_roles_permissions')->insert([
            'module_roles_id' => App\ModuleRole::where('name', 'professor')->first()->id,
            'permission_id' => App\Permission::where('name', 'delete_module')->first()->id,
        ]);
        DB::table('module_roles_permissions')->insert([
            'module_roles_id' => App\ModuleRole::where('name', 'professor')->first()->id,
            'permission_id' => App\Permission::where('name', 'create_coursework')->first()->id,
        ]);
        DB::table('module_roles_permissions')->insert([
            'module_roles_id' => App\ModuleRole::where('name', 'professor')->first()->id,
            'permission_id' => App\Permission::where('name', 'edit_coursework')->first()->id,
        ]);
        DB::table('module_roles_permissions')->insert([
            'module_roles_id' => App\ModuleRole::where('name', 'professor')->first()->id,
            'permission_id' => App\Permission::where('name', 'delete_coursework')->first()->id,
        ]);
        DB::table('module_roles_permissions')->insert([
            'module_roles_id' => App\ModuleRole::where('name', 'professor')->first()->id,
            'permission_id' => App\Permission::where('name', 'mark_submission')->first()->id,
        ]);
    }
}
