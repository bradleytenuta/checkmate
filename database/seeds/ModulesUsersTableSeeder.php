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

        // Assign each user a random module with a random module permission.
        foreach ($users as $user)
        {
            $randomModules = App\Module::inRandomOrder()->get();

            for ($i=0; $i < 3; $i++) {
                
                DB::table('module_user')->insert([
                    'module_id' => $randomModules[$i]->id,
                    'user_id' => $user->id,
                    'module_role_id' => App\ModuleRole::inRandomOrder()->first()->id,
                ]);
            }
        }
    }
}