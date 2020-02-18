<?php

namespace Tests\Feature\app\http\controller;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function showEditCurrentUserTest()
    {
        factory(User::class)->create([
            'global_role_id' => 1,
            'id' => 1
        ]);
    }
}