<?php

use Illuminate\Database\Seeder;

class CourseworksTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        factory(App\Coursework::class, 9)->create();
    }
}
