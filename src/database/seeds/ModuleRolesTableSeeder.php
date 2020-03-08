<?php

use Illuminate\Database\Seeder;

class ModuleRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('module_roles')->insert([
            'name' => "student",
        ]);
        DB::table('module_roles')->insert([
            'name' => "assessor",
        ]);
        DB::table('module_roles')->insert([
            'name' => "professor",
        ]);
    }
}
