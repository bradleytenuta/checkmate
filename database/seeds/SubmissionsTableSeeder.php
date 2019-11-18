<?php

use Illuminate\Database\Seeder;

class SubmissionsTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        factory(App\Submission::class, 50)->create();
    }
}