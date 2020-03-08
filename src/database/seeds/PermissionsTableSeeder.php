<?php

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     * 
     * Permissions are read in from a file.
     *
     * @return void
     */
    public function run() {

        // User related permissions.
        // These permissions are global.
        DB::table('permissions')->insert([
            'name' => "create_user",
        ]);
        DB::table('permissions')->insert([
            'name' => "edit_user",
        ]);
        DB::table('permissions')->insert([
            'name' => "delete_user",
        ]);
        
        // Module related permissions.
        DB::table('permissions')->insert([
            'name' => "create_module",
        ]);
        DB::table('permissions')->insert([
            'name' => "edit_module",
        ]);
        DB::table('permissions')->insert([
            'name' => "delete_module",
        ]);

        // Coursework related permissions.
        DB::table('permissions')->insert([
            'name' => "create_coursework",
        ]);
        DB::table('permissions')->insert([
            'name' => "edit_coursework",
        ]);
        DB::table('permissions')->insert([
            'name' => "delete_coursework",
        ]);

        // Submission related permissions.
        DB::table('permissions')->insert([
            'name' => "create_submission",
        ]);
        DB::table('permissions')->insert([
            'name' => "mark_submission",
        ]);
    }
}