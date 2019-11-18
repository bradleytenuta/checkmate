<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {

    /**
     * Seed the application's database.
     * By calling all the other seeders.
     *
     * @return void
     */
    public function run() {

        // The seeders get called in this order:
        $this->call(UsersTableSeeder::class);
        $this->call(ModulesTableSeeder::class);
        $this->call(CourseworksTableSeeder::class);
        $this->call(SubmissionsTableSeeder::class);

        $this->call(PermissionsTableSeeder::class);
        $this->call(RolesTableSeeder::class);

        // A seeded many to many relationship table.
        $this->call(RolesPermissionsTable::class);
    }
}