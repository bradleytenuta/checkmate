<?php

use Illuminate\Database\Seeder;

class ModulesUsersTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        $users = App\User::all();
        
        // Loops through all the modules and adds each user to one with a random module role.
        App\Module::all()->each(function ($module) use ($users) { 

            foreach ($users as $user) {

                DB::table('module_user')->insert([
                    'module_id' => $module->id,
                    'user_id' => $user->id,
                    'module_role_id' => App\ModuleRole::inRandomOrder()->first()->id,
                ]);
            }
        });
    }
}