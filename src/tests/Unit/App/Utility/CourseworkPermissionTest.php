<?php

namespace Tests\Unit\App\Utility;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\DB;
use App\Utility\CourseworkPermission;
use App\User;
use App\Module;
use App\Coursework;
use DateTime;

class CourseworkPermissionTest extends TestCase
{
    /**
     * Tests that an admin who is not a student can edit.
     *
     * @return void
     */
    public function testAdminCanEdit()
    {
        $user = User::findOrFail("1"); // Gets root admin user.
        $this->be($user); // Mocks Auth::user with this user.

        // Gets a random module, the user is not apart of.
        $exceptModules = Module::all()->except($user->modules->pluck('id')->toArray());

        $this->assertTrue(CourseworkPermission::canEdit($exceptModules->first()));
    }

    /**
     * Tests that the given user who is a professor can edit.
     *
     * @return void
     */
    public function testProfessorCanEdit()
    {
        $professor = User::findOrFail(
            DB::table('module_user')->where('module_role_id', '3')->select('user_id')->first()->user_id);
        $this->be($professor); // Mocks Auth::user with this user.

        $module = Module::findOrFail(
            DB::table('module_user')->where('module_role_id', '3')->select('module_id')->first()->module_id);

        $this->assertTrue(CourseworkPermission::canEdit($module));
    }

    /**
     * Tests that the given user who is an assessor cant edit.
     *
     * @return void
     */
    public function testAssessorCantEdit()
    {
        // Gets an assessor who is not an admin.
        $assessors = DB::table('module_user')->where('module_role_id', '2')->select('user_id')->get();
        foreach($assessors as $assessor)
        {
            $user = User::findOrFail($assessor->user_id);
            if (!$user->hasAdminRole())
            {
                $this->be($user);
                break;
            }
        }

        $module = Module::findOrFail(
            DB::table('module_user')->where('module_role_id', '2')->select('module_id')->first()->module_id);

        $this->assertFalse(CourseworkPermission::canEdit($module));
    }

    /**
     * Tests that the given user who is an student cant edit.
     *
     * @return void
     */
    public function testStudentCantEdit()
    {
        $student = User::findOrFail(
            DB::table('module_user')->where('module_role_id', '1')->select('user_id')->first()->user_id);
        $this->be($student); // Mocks Auth::user with this user.

        $module = Module::findOrFail(
            DB::table('module_user')->where('module_role_id', '1')->select('module_id')->first()->module_id);

        $this->assertFalse(CourseworkPermission::canEdit($module));
    }

    /**
     * Tests that an admin can create.
     *
     * @return void
     */
    public function testAdminCanCreate()
    {
        $user = User::findOrFail("1"); // Gets root admin user.
        $this->be($user); // Mocks Auth::user with this user.

        // Gets a random module, the user is not apart of.
        $exceptModules = Module::all()->except($user->modules->pluck('id')->toArray());

        $this->assertTrue(CourseworkPermission::canCreate($exceptModules->first()));
    }

    /**
     * Tests that a professor can create.
     *
     * @return void
     */
    public function testProfessorCanCreate()
    {
        $professor = User::findOrFail(
            DB::table('module_user')->where('module_role_id', '3')->select('user_id')->first()->user_id);
        $this->be($professor); // Mocks Auth::user with this user.

        $module = Module::findOrFail(
            DB::table('module_user')->where('module_role_id', '3')->select('module_id')->first()->module_id);

        $this->assertTrue(CourseworkPermission::canCreate($module));
    }

    /**
     * Tests that an assessor cannot create.
     *
     * @return void
     */
    public function testAssessorCantCreate()
    {
        // Gets an assessor who is not an admin.
        $assessors = DB::table('module_user')->where('module_role_id', '2')->select('user_id')->get();
        foreach($assessors as $assessor)
        {
            $user = User::findOrFail($assessor->user_id);
            if (!$user->hasAdminRole())
            {
                $this->be($user);
                break;
            }
        }

        $module = Module::findOrFail(
            DB::table('module_user')->where('module_role_id', '2')->select('module_id')->first()->module_id);

        $this->assertFalse(CourseworkPermission::canCreate($module));
    }

    /**
     * Tests that a student cant create.
     *
     * @return void
     */
    public function testStudentCantCreate()
    {
        $student = User::findOrFail(
            DB::table('module_user')->where('module_role_id', '1')->select('user_id')->first()->user_id);
        $this->be($student); // Mocks Auth::user with this user.

        $module = Module::findOrFail(
            DB::table('module_user')->where('module_role_id', '1')->select('module_id')->first()->module_id);

        $this->assertFalse(CourseworkPermission::canCreate($module));
    }

    /**
     * Tests that an admin can mark.
     *
     * @return void
     */
    public function testAdminCanMark()
    {
        $user = User::findOrFail("1"); // Gets root admin user.
        $this->be($user); // Mocks Auth::user with this user.

        // Gets a random module, the user is not apart of.
        $exceptModules = Module::all()->except($user->modules->pluck('id')->toArray());

        $this->assertTrue(CourseworkPermission::canMark($exceptModules->first()));
    }

    /**
     * Tests that a professor can mark.
     *
     * @return void
     */
    public function testProfessorCanMark()
    {
        $professor = User::findOrFail(
            DB::table('module_user')->where('module_role_id', '3')->select('user_id')->first()->user_id);
        $this->be($professor); // Mocks Auth::user with this user.

        $module = Module::findOrFail(
            DB::table('module_user')->where('module_role_id', '3')->select('module_id')->first()->module_id);

        $this->assertTrue(CourseworkPermission::canMark($module));
    }

    /**
     * Tests that a assessor can mark.
     *
     * @return void
     */
    public function testAssessorCanMark()
    {
        // Gets an assessor who is not an admin.
        $assessors = DB::table('module_user')->where('module_role_id', '2')->select('user_id')->get();
        foreach($assessors as $assessor)
        {
            $user = User::findOrFail($assessor->user_id);
            if (!$user->hasAdminRole())
            {
                $this->be($user);
                break;
            }
        }

        $module = Module::findOrFail(
            DB::table('module_user')->where('module_role_id', '2')->select('module_id')->first()->module_id);

        $this->assertTrue(CourseworkPermission::canMark($module));
    }

    /**
     * Tests that a student cant mark.
     *
     * @return void
     */
    public function testStudentCantMark()
    {
        $student = User::findOrFail(
            DB::table('module_user')->where('module_role_id', '1')->select('user_id')->first()->user_id);
        $this->be($student); // Mocks Auth::user with this user.

        $module = Module::findOrFail(
            DB::table('module_user')->where('module_role_id', '1')->select('module_id')->first()->module_id);

        $this->assertFalse(CourseworkPermission::canMark($module));
    }

    /**
     * Tests that an admin can delete.
     *
     * @return void
     */
    public function testAdminCanDelete()
    {
        $user = User::findOrFail("1"); // Gets root admin user.
        $this->be($user); // Mocks Auth::user with this user.

        // Gets a random module, the user is not apart of.
        $exceptModules = Module::all()->except($user->modules->pluck('id')->toArray());

        $this->assertTrue(CourseworkPermission::canDelete($exceptModules->first()));
    }

    /**
     * Tests that a professor can delete.
     *
     * @return void
     */
    public function testProfessorCanDelete()
    {
        $professor = User::findOrFail(
            DB::table('module_user')->where('module_role_id', '3')->select('user_id')->first()->user_id);
        $this->be($professor); // Mocks Auth::user with this user.

        $module = Module::findOrFail(
            DB::table('module_user')->where('module_role_id', '3')->select('module_id')->first()->module_id);

        $this->assertTrue(CourseworkPermission::canDelete($module));
    }

    /**
     * Tests that a assessor cant delete.
     *
     * @return void
     */
    public function testAssessorCantDelete()
    {
        // Gets an assessor who is not an admin.
        $assessors = DB::table('module_user')->where('module_role_id', '2')->select('user_id')->get();
        foreach($assessors as $assessor)
        {
            $user = User::findOrFail($assessor->user_id);
            if (!$user->hasAdminRole())
            {
                $this->be($user);
                break;
            }
        }

        $module = Module::findOrFail(
            DB::table('module_user')->where('module_role_id', '2')->select('module_id')->first()->module_id);

        $this->assertFalse(CourseworkPermission::canDelete($module));
    }

    /**
     * Tests that a student cant delete.
     *
     * @return void
     */
    public function testStudentCantDelete()
    {
        $student = User::findOrFail(
            DB::table('module_user')->where('module_role_id', '1')->select('user_id')->first()->user_id);
        $this->be($student); // Mocks Auth::user with this user.

        $module = Module::findOrFail(
            DB::table('module_user')->where('module_role_id', '1')->select('module_id')->first()->module_id);

        $this->assertFalse(CourseworkPermission::canDelete($module));
    }

    /**
     * Tests that an admin can view a coursework.
     *
     * @return void
     */
    public function testAdminCanShow()
    {
        $user = User::findOrFail("1"); // Gets root admin user.
        $this->be($user); // Mocks Auth::user with this user.

        $coursework = Coursework::all()->first();
        $this->assertTrue(CourseworkPermission::canShow($coursework));
    }

    /**
     * Tests that a non admin can't view a coursework they are not enrolled on.
     *
     * @return void
     */
    public function testNotAdminNotEnrolledCantShow()
    {
        $user = User::findOrFail("2"); // User with id 2, doesnt have admin rights.
        $this->be($user); // Mocks Auth::user with this user.

        $modules = Module::all();
        $exceptModules = $modules->except($user->modules->pluck('id')->toArray());
        $this->assertFalse(CourseworkPermission::canShow($exceptModules->first()->courseworks->first()));
    }

    /**
     * Tests that a non admin can't view a coursework if it hasnt started yet.
     *
     * @return void
     */
    public function testNotAdminCourseworkNotStarted()
    {
        // Gets the first coursework that starts in the future.
        $coursework = Coursework::where("start_date", ">", new DateTime())->first();

        // Finds user in coursework
        $user = User::findOrFail(
            DB::table('module_user')->where('module_role_id', '1')->where('module_id', $coursework->module->id)->select('user_id')->first()->user_id);
        $this->be($user); // Mocks Auth::user with this user.

        $this->assertFalse(CourseworkPermission::canShow($coursework));
    }
}