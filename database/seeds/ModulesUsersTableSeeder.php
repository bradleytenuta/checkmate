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

        // Assigns the test admin account to module 1.
        DB::table('module_user')->insert([
            'module_id' => 1,
            'user_id' => App\User::where('id', 1)->first()->id,
            'module_role_id' => App\ModuleRole::where('id', 1)->first()->id,
        ]);

        // Assigns the test non admin account to module 1.
        DB::table('module_user')->insert([
            'module_id' => 1,
            'user_id' => App\User::where('id', 2)->first()->id,
            'module_role_id' => App\ModuleRole::where('id', 1)->first()->id,
        ]);

        // Assign each user a random module with a random module permission.
        foreach ($users as $user)
        {
            $randomModules = App\Module::inRandomOrder()->get();

            for ($i=0; $i < 8; $i++) {
                
                DB::table('module_user')->insert([
                    'module_id' => $randomModules[$i]->id,
                    'user_id' => $user->id,
                    'module_role_id' => App\ModuleRole::inRandomOrder()->first()->id,
                ]);
            }
        }
    }
}