<?php

use Illuminate\Database\Seeder;

class CourseworkTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('coursework_types')->insert([
            'name' => "Java",
            'test_file_extenstion' => 'java'
        ]);
    }
}
