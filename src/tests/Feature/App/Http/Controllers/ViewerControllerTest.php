<?php

namespace Tests\Feature\App\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\User;
use App\Module;
use App\Submission;

class ViewerControllerTest extends TestCase
{
    /**
     * Tests that a user can mark a submission.
     *
     * @return void
     */
    public function testSaveMark()
    {
        $user = User::findOrFail("1"); // Logged in as admin.
        $module = Module::all()->except($user->modules->pluck('id')->toArray())->first();
        $coursework = $module->courseworks->first();
        $submission = Submission::inRandomOrder()->where("coursework_id", $coursework->id)->first();

        $response = $this->actingAs($user)
            ->post("modules/" . $module->id . "/courseworks/" . $coursework->id . "/submission/" . $submission->id . "/save", 
                ['score' => 80,
                1 => "A inline comment for line 1."]);

        $response->assertStatus(302); // Response is redirected.
        $this->assertTrue(Submission::findOrFail($submission->id)->score == 80);
    }
}