<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\User;

class RouteTest extends TestCase
{
    /**
     * Tests that when given root url it redirects the user to the login page.
     *
     * @return void
     */
    public function testLoginRedirect()
    {
        $response = $this->get('/');
        $response->assertStatus(302); // Checks a redirect has happened.
        $this->assertTrue(strpos($response->getTargetUrl(), 'login') !== false); // Checks the redirect went to the login page.
    }

    /**
     * Tests that when given root url it redirects the logged in user to the home page.
     *
     * @return void
     */
    public function testHomeRedirect()
    {
        // Logs in a user then generates a response.
        $user = User::findOrFail("1");
        $response = $this->actingAs($user)
                         ->get('/home');
        $response->assertStatus(200); // Response is OK
    }
}