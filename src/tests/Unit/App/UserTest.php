<?php

namespace Tests\Unit\App;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use App\User;
use App\Module;

class UserTest extends TestCase
{
    /**
     * Tests that the root admin user exists and as admin rights.
     *
     * @return void
     */
    public function testRootAdminUserExists()
    {
        // Gets the user with the given ID.
        // The root admin user should have an id of 1.
        $user = User::findOrFail("1");

        // Runs tests on user.
        $this->assertTrue($user->hasAdminRole());
    }

    /**
     * Tests a user is in a given module.
     *
     * @return void
     */
    public function testUserInModuleTrue()
    {
        $user = User::findOrFail("1");
        $this->assertTrue($user->isInModule($user->modules->first()));
    }

    /**
     * Tests a user is not in a given module.
     *
     * @return void
     */
    public function testUserInModuleFalse()
    {
        $user = User::findOrFail("1");

        // Gets all modules.
        $modules = Module::all();

        // Returns a collection of modules that the user is not enrolled on.
        $exceptModules = $modules->except($user->modules->pluck('id')->toArray());

        $this->assertFalse($user->isInModule($exceptModules->first()));
    }
}