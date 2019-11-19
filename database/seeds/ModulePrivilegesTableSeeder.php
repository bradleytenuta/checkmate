<?php

use Illuminate\Database\Seeder;

class ModulePrivilegesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Loops through all the users
        App\User::all()->each(function ($user) { 

            // Loops through every module the user has and assigns them a role within that module.
            foreach ($user->modules as $module) {

                // Gets a random role, but makes sure its not an admin role.
                // This is because an admin role is for global privileges only.
                $random_role = App\ModuleRole::inRandomOrder()->first();

                // Adds it to the database.
                DB::table('module_privileges')->insert([
                    'user_id' => $user->id,
                    'module_role_id' => $random_role->id,
                    'module_id' => $module->id
                ]);
            }
        });
    }
}
