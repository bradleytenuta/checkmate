<?php

namespace Tests\Feature\App\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\User;

class UserControllerTest extends TestCase
{
    /**
     * Tests that a user can be deleted correctly.
     *
     * @return void
     */
    public function testDeleteUser()
    {
        $user = User::findOrFail("1"); // Logged in as admin.

        // Grabs a user to delete.
        $userToDelete = User::whereNotIn('email', ['bradley@example.com', 'test@example.com'])->first();

        $response = $this->actingAs($user)
                         ->post("/users/" . $userToDelete->id . "/delete");

        $response->assertStatus(302); // Response is redirected.
        $this->assertFalse(User::all()->contains('id', $userToDelete->id));
    }

    /**
     * Tests that an admin user can edit another user correctly.
     *
     * @return void
     */
    public function testEditUser()
    {
        $user = User::findOrFail("1"); // Logged in as admin.

        // Grabs a user to edit.
        $userToEdit = User::whereNotIn('email', ['bradley@example.com', 'test@example.com'])->first();

        // Creates a unique number to help prevent duplication in multiple runs of tests.
        $num = rand(1,10000);
        $newName = $userToEdit->firstname . $num;

        $response = $this->actingAs($user)
            ->post('/users/' . $userToEdit->id . '/edit', 
                ['firstname' => $newName,
                'surname' => $userToEdit->surname,
                'email' => $userToEdit->email]);

        $response->assertStatus(302); // Response is redirected.
        $this->assertTrue(User::findOrFail($userToEdit->id)->firstname == $newName);
    }
}