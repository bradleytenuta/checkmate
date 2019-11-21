<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        // Creates user with admin rights.
        App\User::create([
            'firstname' => 'Bradley',
            'surname' => 'Tenuta',
            'email' => 'bradley@example.com',
            'password' => Hash::make('password'),
        ]);

        // Creates user without admin rights.
        // As only the first user created gets admin rights.
        App\User::create([
            'firstname' => 'John',
            'surname' => 'Doe',
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
        ]);

        factory(App\User::class, 50)->create();
    }
}