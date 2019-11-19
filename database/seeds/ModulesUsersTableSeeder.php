<?php

use Illuminate\Database\Seeder;

class ModulesUsersTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        // Gets all the users and all the modules
        $modules = App\Module::all();
        
        // Loops through all the users and adds the user to a random number of the modules.
        App\User::all()->each(function ($user) use ($modules) { 
            $user->modules()->attach(
                $modules->random(rand(1, 5))->pluck('id')->toArray()
            ); 
        });
    }
}