<?php

namespace Tests\Feature\App\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\DB;
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
        // Finds a user who is an assessor and the module they are an assessor in.
        $moduleRoleRow = DB::table('module_user')->where('module_role_id', '2')->select('user_id', 'module_id')->get()->first();
        $user = User::findOrFail($moduleRoleRow->user_id);
        $module = Module::findOrFail($moduleRoleRow->module_id);

        // Gets the submission from the first coursework in the module.
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