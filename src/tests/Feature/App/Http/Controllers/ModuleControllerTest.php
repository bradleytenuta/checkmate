<?php

namespace Tests\Feature\App\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\User;
use App\Module;

class ModuleControllerTest extends TestCase
{
    /**
     * Tests that an admin user can delete a module.
     *
     * @return void
     */
    public function testDeleteModule()
    {
        $user = User::findOrFail("1"); // Logged in as admin.

        // Finds a module.
        $module = Module::all()->shuffle()->first();

        $response = $this->actingAs($user)
                         ->post("modules/" . $module->id . "/delete");

        $response->assertStatus(302); // Response is redirected.
        $this->assertFalse(Module::all()->contains('id', $module->id));
    }

    /**
     * Tests that an admin user can edit a module.
     *
     * @return void
     */
    public function testEditModule()
    {
        $user = User::findOrFail("1"); // Logged in as admin.

        // Finds a module.
        $module = Module::all()->except($user->modules->pluck('id')->toArray())->shuffle()->first();

        // Creates a unique number to help prevent duplication in multiple runs of tests.
        $num = rand(1,10000);
        $newName = $module->name . $num;

        // Adds 3 users to the module with 3 different roles.
        $usersToAdd = User::inRandomOrder()->where("global_role_id", 2)->get()->splice(0, 3);

        $response = $this->actingAs($user)
            ->post("modules/edit", 
                ['id' => $module->id,
                'name' => $newName,
                'description' => $module->description,
                $usersToAdd[0]->id => "1",
                $usersToAdd[1]->id => "2",
                $usersToAdd[2]->id => "3"]);

        $this->assertTrue(Module::findOrFail($module->id)->name == $newName);
    }

    /**
     * Tests that a user can't edit a module to have no professors.
     *
     * @return void
     */
    public function testEditModuleInvalidRoles()
    {
        $user = User::findOrFail("1"); // Logged in as admin.

        // Finds a module.
        $module = Module::all()->except($user->modules->pluck('id')->toArray())->shuffle()->first();

        // Creates a unique number to help prevent duplication in multiple runs of tests.
        $num = rand(1,10000);
        $newName = $module->name . $num;

        // Adds 3 users to the module with 3 different roles.
        $usersToAdd = User::inRandomOrder()->where("global_role_id", 2)->get()->splice(0, 3);

        $response = $this->actingAs($user)
            ->post("modules/edit", 
                ['id' => $module->id,
                'name' => $newName,
                'description' => $module->description]);

        $response->assertStatus(302); // Server should return error.
        $this->assertFalse(Module::findOrFail($module->id)->name == $newName);
    }

    /**
     * Tests that a module cant have an int for a name.
     *
     * @return void
     */
    public function testEditModuleInvalidName()
    {
        $user = User::findOrFail("1"); // Logged in as admin.

        // Finds a module.
        $module = Module::all()->except($user->modules->pluck('id')->toArray())->shuffle()->first();

        // Creates a unique number to help prevent duplication in multiple runs of tests.
        $num = rand(1,10000);

        // Adds 3 users to the module with 3 different roles.
        $usersToAdd = User::inRandomOrder()->where("global_role_id", 2)->get()->splice(0, 3);

        $response = $this->actingAs($user)
            ->post("modules/edit", 
                ['id' => $module->id,
                'name' => $num,
                'description' => $module->description,
                $usersToAdd[0]->id => "1",
                $usersToAdd[1]->id => "2",
                $usersToAdd[2]->id => "3"]);

        $response->assertStatus(302); // Server should return error.
        $this->assertFalse(Module::findOrFail($module->id)->name == $num);
    }

    /**
     * Tests that an admin user can create a module.
     *
     * @return void
     */
    public function testCreateModule()
    {
        $user = User::findOrFail("1"); // Logged in as admin.

        // Creates a unique number to help prevent duplication in multiple runs of tests.
        $num = rand(1,10000);
        $name = "testModule" . $num;

        // Adds 3 users to the module with 3 different roles.
        $usersToAdd = User::inRandomOrder()->where("global_role_id", 2)->get()->splice(0, 3);

        $response = $this->actingAs($user)
            ->post("modules/create", 
                ['name' => $name,
                'description' => "test description",
                $usersToAdd[0]->id => "1",
                $usersToAdd[1]->id => "2",
                $usersToAdd[2]->id => "3"]);

        $response->assertStatus(302); // Response is redirected.
        $this->assertTrue(Module::all()->contains('name', $name));
    }

    /**
     * Tests that an admin user cant create a module with no professor.
     *
     * @return void
     */
    public function testCreateModuleInvalidRoles()
    {
        $user = User::findOrFail("1"); // Logged in as admin.

        // Creates a unique number to help prevent duplication in multiple runs of tests.
        $num = rand(1,10000);
        $name = "testModule" . $num;

        // Adds 3 users to the module with 3 different roles.
        $usersToAdd = User::inRandomOrder()->where("global_role_id", 2)->get()->splice(0, 3);

        $response = $this->actingAs($user)
            ->post("modules/create", 
                ['name' => $name,
                'description' => "test description"]);

        $response->assertStatus(302); // Response is redirected.
        $this->assertFalse(Module::all()->contains('name', $name));
    }

    /**
     * Tests that an admin user cant create a module with an int for a name.
     *
     * @return void
     */
    public function testCreateModuleInvalidName()
    {
        $user = User::findOrFail("1"); // Logged in as admin.

        // Creates a unique number to help prevent duplication in multiple runs of tests.
        $num = rand(1,10000);

        // Adds 3 users to the module with 3 different roles.
        $usersToAdd = User::inRandomOrder()->where("global_role_id", 2)->get()->splice(0, 3);

        $response = $this->actingAs($user)
            ->post("modules/create", 
                ['name' => $num,
                'description' => "test description",
                $usersToAdd[0]->id => "1",
                $usersToAdd[1]->id => "2",
                $usersToAdd[2]->id => "3"]);

        $response->assertStatus(302); // Response is redirected.
        $this->assertFalse(Module::all()->contains('name', $num));
    }
}