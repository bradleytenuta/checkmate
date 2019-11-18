<?php

use Illuminate\Database\Seeder;

// TODO: Convert this to read in an xml file.
class RolesTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     * 
     * Roles are read in from a file.
     *
     * @return void
     */
    public function run() {
        
        DB::table('roles')->insert([
            'name' => "admin",
        ]);
        DB::table('roles')->insert([
            'name' => "student",
        ]);
        DB::table('roles')->insert([
            'name' => "professor",
        ]);
        DB::table('roles')->insert([
            'name' => "assessor",
        ]);
    }
}
