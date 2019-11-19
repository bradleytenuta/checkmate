<?php

use Illuminate\Database\Seeder;

class GlobalPrivilegesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Gives the first user found global admin rights.
        DB::table('global_privileges')->insert([
            'user_id' => App\User::get()->first()->id,
            'global_role_id' => App\GlobalRole::get()->first()->id
        ]);
    }
}
