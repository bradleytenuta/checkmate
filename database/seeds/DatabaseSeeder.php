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

        // Populates the modules and users table, a many-to-many table.
        $this->call(ModulesUsersTableSeeder::class);

        $this->call(CourseworksTableSeeder::class);
        $this->call(SubmissionsTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);

        // Populates the global roles and permissions table.
        $this->call(GlobalRolesTableSeeder::class);
        $this->call(GlobalRolesPermissionsTableSeeder::class);

        // Populates the module roles and permissions table.
        $this->call(ModuleRolesTableSeeder::class);
        $this->call(ModuleRolesPermissionsTableSeeder::class);

        // Populates the user privileges tables.
        $this->call(ModulePrivilegesTableSeeder::class);
        $this->call(GlobalPrivilegesTableSeeder::class);
    }
}