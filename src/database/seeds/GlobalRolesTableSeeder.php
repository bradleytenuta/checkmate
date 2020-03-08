<?php

use Illuminate\Database\Seeder;

class GlobalRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('global_roles')->insert([
            'name' => "admin",
        ]);
        DB::table('global_roles')->insert([
            'name' => "standard",
        ]);
    }
}
