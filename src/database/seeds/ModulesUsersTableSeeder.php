<?php

use Illuminate\Database\Seeder;

class ModulesUsersTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        // Assigns the test admin account to module 1.
        DB::table('module_user')->insertOrIgnore([
            'module_id' => 1,
            'user_id' => App\User::where('id', 1)->first()->id,
            'module_role_id' => App\ModuleRole::where('id', 1)->first()->id,
        ]);

        // Assigns the test non admin account to module 1.
        DB::table('module_user')->insertOrIgnore([
            'module_id' => 1,
            'user_id' => App\User::where('id', 2)->first()->id,
            'module_role_id' => App\ModuleRole::where('id', 1)->first()->id,
        ]);

        $modules = App\Module::all();
        foreach ($modules as $module)
        {
            // Adds inital users.
            $this->addInitalUsers($module);

            // Gets all users and randomly adds a number of them to the module.
            $users = App\User::all()->shuffle();
            for ($i = 0; $i < rand(10, $users->count()); $i++)
            {
                DB::table('module_user')->insertOrIgnore([
                    'module_id' => $module->id,
                    'user_id' => $users[$i]->id,
                    'module_role_id' => App\ModuleRole::inRandomOrder()->first()->id,
                ]);
            }
        }
    }

    /**
     * This fucntion adds 3 random users to a module, each user having one
     * of the different roles.
     */
    private function addInitalUsers($module)
    {
        // Gets the three users that are not admins.
        $users = App\User::inRandomOrder()->where("global_role_id", 2)->get()->splice(0, 3);

        // Makes sure there is at least 1 student in a module.
        DB::table('module_user')->insertOrIgnore([
            'module_id' => $module->id,
            'user_id' => $users[0]->id,
            'module_role_id' => App\ModuleRole::findOrFail(1)->id,
        ]);

        // Makes sure there is at least 1 assessor in a module.
        DB::table('module_user')->insertOrIgnore([
            'module_id' => $module->id,
            'user_id' => $users[1]->id,
            'module_role_id' => App\ModuleRole::findOrFail(2)->id,
        ]);

        // Makes sure there is at least 1 professor in a module.
        DB::table('module_user')->insertOrIgnore([
            'module_id' => $module->id,
            'user_id' => $users[2]->id,
            'module_role_id' => App\ModuleRole::findOrFail(3)->id,
        ]);
    }
}