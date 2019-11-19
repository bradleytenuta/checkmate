<?php

use Illuminate\Database\Seeder;

// TODO: Convert this to read in an xml file.
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
            'name' => "professor",
        ]);
        DB::table('module_roles')->insert([
            'name' => "assessor",
        ]);
    }
}
