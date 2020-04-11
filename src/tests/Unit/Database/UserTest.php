<?php

namespace Tests\Unit\App\Database;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\User;

class UserTest extends TestCase
{
    /**
     * Tests that the admin user exists.
     *
     * @return void
     */
    public function testUserDatabaseAdminUser()
    {
        $this->assertDatabaseHas('users', [
            'email' => 'bradley@example.com',
            'id' => '1'
        ]);
    }

    /**
     * Tests that the test user exists.
     *
     * @return void
     */
    public function testUserDatabaseTestUser()
    {
        $this->assertDatabaseHas('users', [
            'email' => 'test@example.com',
            'id' => '2'
        ]);
    }
}