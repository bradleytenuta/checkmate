<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        // Makes an admin account for testing.
        /*
        DB::table('users')->insert([
            'firstname' => 'Bradley',
            'surname' => 'Tenuta',
            'email' => 'admin@example.org',
            'password' => 'password'
        ]);*/

        // Runs the factory.
        factory(App\User::class, 50)->create();
    }
}