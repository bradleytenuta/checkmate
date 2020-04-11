<?php

namespace Tests\Feature\App\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\User;
use App\Module;
use App\Coursework;

class CourseworkControllerTest extends TestCase
{
    /**
     * Tests that a user can delete a coursework.
     *
     * @return void
     */
    public function testDeleteCoursework()
    {
        $user = User::findOrFail("1"); // Logged in as admin.
        $exceptModules = Module::all()->except($user->modules->pluck('id')->toArray());
        $coursework = Coursework::whereIn('module_id', $exceptModules->pluck('id')->toArray())->first();

        $response = $this->actingAs($user)
                         ->post("modules/" . $coursework->module->id . "/courseworks/" . $coursework->id . "/delete");

        $response->assertStatus(302); // Response is redirected.
        $this->assertFalse(Coursework::all()->contains('id', $coursework->id));
    }

    /**
     * Tests that a user can create a coursework.
     *
     * @return void
     */
    public function testCreateCoursework()
    {
        $user = User::findOrFail("1"); // Logged in as admin.
        $module = Module::all()->except($user->modules->pluck('id')->toArray())->shuffle()->first();

        // Creates a unique number to help prevent duplication in multiple runs of tests.
        $num = rand(1,10000);
        $newName = "testCoursework" . $num;

        $response = $this->actingAs($user)
            ->post("modules/" . $module->id . "/courseworks/create",
                ['module_id' => $module->id,
                'name' => $newName,
                'description' => "test description",
                'maximum_score' => 100,
                'deadline' => date("Y-m-d"),
                'start_date' => date("Y-m-d"),
                'coursework_type_id' => 1]);

        $response->assertStatus(302); // Response is redirected.
        $this->assertTrue(Coursework::all()->contains('name', $newName));
    }

    /**
     * Tests that a user can edit a coursework.
     *
     * @return void
     */
    public function testEditCoursework()
    {
        $user = User::findOrFail("1"); // Logged in as admin.
        $exceptModules = Module::all()->except($user->modules->pluck('id')->toArray());
        $coursework = Coursework::whereIn('module_id', $exceptModules->pluck('id')->toArray())->first();

        // Creates a unique number to help prevent duplication in multiple runs of tests.
        $num = rand(1,10000);
        $newName = $coursework->name . $num;

        $response = $this->actingAs($user)
            ->post("modules/" . $coursework->module->id . "/courseworks/edit",
                ['id' => $coursework->id,
                'name' => $newName,
                'description' => $coursework->description,
                'maximum_score' => $coursework->maximum_score,
                'deadline' => $coursework->deadline,
                'start_date' => $coursework->start_date,
                'coursework_type_id' => $coursework->coursework_type_id]);

        $this->assertTrue(Coursework::findOrFail($coursework->id)->name == $newName);
    }
}