<?php

namespace Tests\Feature\App\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\User;
use App\Module;
use App\Coursework;
use DateTime;
use DateInterval;

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
     * Tests that a user cant create a coursework with an int for a name.
     *
     * @return void
     */
    public function testCreateCourseworkInvalidName()
    {
        $user = User::findOrFail("1"); // Logged in as admin.
        $module = Module::all()->except($user->modules->pluck('id')->toArray())->shuffle()->first();

        // Creates a unique number to help prevent duplication in multiple runs of tests.
        $num = rand(1,10000);

        $response = $this->actingAs($user)
            ->post("modules/" . $module->id . "/courseworks/create",
                ['module_id' => $module->id,
                'name' => $num,
                'description' => "test description",
                'maximum_score' => 100,
                'deadline' => date("Y-m-d"),
                'start_date' => date("Y-m-d"),
                'coursework_type_id' => 1]);

        $response->assertStatus(302); // Response is redirected.
        $this->assertFalse(Coursework::all()->contains('name', $num));
    }

    /**
     * Tests that a user cant create a coursework with a string for a score.
     *
     * @return void
     */
    public function testCreateCourseworkInvalidScore()
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
                'maximum_score' => "testing",
                'deadline' => date("Y-m-d"),
                'start_date' => date("Y-m-d"),
                'coursework_type_id' => 1]);

        $response->assertStatus(302); // Response is redirected.
        $this->assertFalse(Coursework::all()->contains('name', $newName));
    }

    /**
     * Tests that a user cant create a coursework with a deadline in the past.
     *
     * @return void
     */
    public function testCreateCourseworkInvalidDate()
    {
        $user = User::findOrFail("1"); // Logged in as admin.
        $module = Module::all()->except($user->modules->pluck('id')->toArray())->shuffle()->first();

        // Creates a unique number to help prevent duplication in multiple runs of tests.
        $num = rand(1,10000);
        $newName = "testCoursework" . $num;

        // Date in the past
        $deadline = new DateTime();
        $deadline->sub(new DateInterval('P1D'));

        $response = $this->actingAs($user)
            ->post("modules/" . $module->id . "/courseworks/create",
                ['module_id' => $module->id,
                'name' => $newName,
                'description' => "test description",
                'maximum_score' => 100,
                'deadline' => date_format($deadline, "Y-m-d"),
                'start_date' => date("Y-m-d"),
                'coursework_type_id' => 1]);

        $response->assertStatus(302); // Response is redirected.
        $this->assertFalse(Coursework::all()->contains('name', $newName));
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

    /**
     * Tests that a user cant edit a coursework with an int for a name.
     *
     * @return void
     */
    public function testEditCourseworkInvalidName()
    {
        $user = User::findOrFail("1"); // Logged in as admin.
        $exceptModules = Module::all()->except($user->modules->pluck('id')->toArray());
        $coursework = Coursework::whereIn('module_id', $exceptModules->pluck('id')->toArray())->first();

        // Creates a unique number to help prevent duplication in multiple runs of tests.
        $num = rand(1,10000);

        $response = $this->actingAs($user)
            ->post("modules/" . $coursework->module->id . "/courseworks/edit",
                ['id' => $coursework->id,
                'name' => $num,
                'description' => $coursework->description,
                'maximum_score' => $coursework->maximum_score,
                'deadline' => $coursework->deadline,
                'start_date' => $coursework->start_date,
                'coursework_type_id' => $coursework->coursework_type_id]);

        $this->assertFalse(Coursework::findOrFail($coursework->id)->name == $num);
    }

    /**
     * Tests that a user cant edit a coursework with a string for a score.
     *
     * @return void
     */
    public function testEditCourseworkInvalidScore()
    {
        $user = User::findOrFail("1"); // Logged in as admin.
        $exceptModules = Module::all()->except($user->modules->pluck('id')->toArray());
        $coursework = Coursework::whereIn('module_id', $exceptModules->pluck('id')->toArray())->first();

        $response = $this->actingAs($user)
            ->post("modules/" . $coursework->module->id . "/courseworks/edit",
                ['id' => $coursework->id,
                'name' => $coursework->name,
                'description' => $coursework->description,
                'maximum_score' => "hello",
                'deadline' => $coursework->deadline,
                'start_date' => $coursework->start_date,
                'coursework_type_id' => $coursework->coursework_type_id]);

        $this->assertFalse(Coursework::findOrFail($coursework->id)->maximum_score == "hello");
    }
}