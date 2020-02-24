<?php

use Illuminate\Database\Seeder;

// TODO: Convert this to read in an xml file.
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
            'name' => "java",
        ]);
    }
}
