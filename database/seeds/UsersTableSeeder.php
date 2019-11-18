<?php

use App\User;
use App\Role;
use App\Module;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        factory(App\User::class, 50)->create();

        // Randomly allocates Roles to user.
        $this->allocateUserModuleRoles();
    }

    /**
     * This function randomly allocates a role to user for a certain module.
     */
    private function allocateUserModuleRoles() {

        // Loops through all the users
        User::all()->each(function ($user) { 

            // Gets a random role and a random module.
            $random_role_id = Role::inRandomOrder()->first()->id;
            $random_module_id = Module::inRandomOrder()->first()->id;
            
            // Assigns the role to the user for that module.
            $user->assignRoleTo()->attach($random_role_id, $random_module_id);
        });
    }
}