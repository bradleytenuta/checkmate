<?php

namespace Tests\Unit\App\Utility;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\DB;
use App\Utility\ModulePermission;
use App\User;
use App\Module;

class ModulePermissionTest extends TestCase
{
    /**
     * Tests that the user has the right role.
     *
     * @return void
     */
    public function testHasRoleProfessor()
    {
        $user = User::findOrFail(
            DB::table('module_user')->where('module_role_id', '3')->select('user_id')->first()->user_id);
        $this->be($user); // Mocks Auth::user with this user.

        $module = Module::findOrFail(
            DB::table('module_user')->where('module_role_id', '3')->select('module_id')->first()->module_id);

        $this->assertTrue(ModulePermission::hasRole($module, $user, "professor"));
    }

    /**
     * Tests that the user has the right role.
     *
     * @return void
     */
    public function testHasRoleAssessor()
    {
        $user = User::findOrFail(
            DB::table('module_user')->where('module_role_id', '2')->select('user_id')->first()->user_id);
        $this->be($user); // Mocks Auth::user with this user.

        $module = Module::findOrFail(
            DB::table('module_user')->where('module_role_id', '2')->select('module_id')->first()->module_id);

        $this->assertTrue(ModulePermission::hasRole($module, $user, "assessor"));
    }

    /**
     * Tests that the user has the right role.
     *
     * @return void
     */
    public function testHasRoleStudent()
    {
        $user = User::findOrFail(
            DB::table('module_user')->where('module_role_id', '1')->select('user_id')->first()->user_id);
        $this->be($user); // Mocks Auth::user with this user.

        $module = Module::findOrFail(
            DB::table('module_user')->where('module_role_id', '1')->select('module_id')->first()->module_id);

        $this->assertTrue(ModulePermission::hasRole($module, $user, "student"));
    }

    /**
     * Tests that should fail as the user has wrong role.
     *
     * @return void
     */
    public function testHasRoleWrong()
    {
        $user = User::findOrFail(
            DB::table('module_user')->where('module_role_id', '1')->select('user_id')->first()->user_id);
        $this->be($user); // Mocks Auth::user with this user.

        $module = Module::findOrFail(
            DB::table('module_user')->where('module_role_id', '1')->select('module_id')->first()->module_id);

        $this->assertFalse(ModulePermission::hasRole($module, $user, "assessor"));
    }

    /**
     * Tests that the right icon for the role is returned.
     *
     * @return void
     */
    public function testPermissionIconProfessor()
    {
        $user = User::findOrFail(
            DB::table('module_user')->where('module_role_id', '3')->select('user_id')->first()->user_id);
        $this->be($user); // Mocks Auth::user with this user.

        $module = Module::findOrFail(
            DB::table('module_user')->where('module_role_id', '3')->select('module_id')->first()->module_id);

        $this->assertTrue(ModulePermission::permissionIconPath($module, $user) == "/images/icon/module-icon-professor.png");
    }

    /**
     * Tests that the right icon for the role is returned.
     *
     * @return void
     */
    public function testPermissionIconAssessor()
    {
        $user = User::findOrFail(
            DB::table('module_user')->where('module_role_id', '2')->select('user_id')->first()->user_id);
        $this->be($user); // Mocks Auth::user with this user.

        $module = Module::findOrFail(
            DB::table('module_user')->where('module_role_id', '2')->select('module_id')->first()->module_id);

        $this->assertTrue(ModulePermission::permissionIconPath($module, $user) == "/images/icon/module-icon-assessor.png");
    }

    /**
     * Tests that the right icon for the role is returned.
     *
     * @return void
     */
    public function testPermissionIconStudent()
    {
        $user = User::findOrFail(
            DB::table('module_user')->where('module_role_id', '1')->select('user_id')->first()->user_id);
        $this->be($user); // Mocks Auth::user with this user.

        $module = Module::findOrFail(
            DB::table('module_user')->where('module_role_id', '1')->select('module_id')->first()->module_id);

        $this->assertTrue(ModulePermission::permissionIconPath($module, $user) == "/images/icon/module-icon-student.png");
    }

    /**
     * Tests that the right text for the role is returned.
     *
     * @return void
     */
    public function testPermissionTextProfessor()
    {
        $user = User::findOrFail(
            DB::table('module_user')->where('module_role_id', '3')->select('user_id')->first()->user_id);
        $this->be($user); // Mocks Auth::user with this user.

        $module = Module::findOrFail(
            DB::table('module_user')->where('module_role_id', '3')->select('module_id')->first()->module_id);

        $this->assertTrue(ModulePermission::permissionText($module, $user) == "Professor");
    }

    /**
     * Tests that the right text for the role is returned.
     *
     * @return void
     */
    public function testPermissionTextAssessor()
    {
        $user = User::findOrFail(
            DB::table('module_user')->where('module_role_id', '2')->select('user_id')->first()->user_id);
        $this->be($user); // Mocks Auth::user with this user.

        $module = Module::findOrFail(
            DB::table('module_user')->where('module_role_id', '2')->select('module_id')->first()->module_id);

        $this->assertTrue(ModulePermission::permissionText($module, $user) == "Assessor");
    }

    /**
     * Tests that the right text for the role is returned.
     *
     * @return void
     */
    public function testPermissionTextStudent()
    {
        $user = User::findOrFail(
            DB::table('module_user')->where('module_role_id', '1')->select('user_id')->first()->user_id);
        $this->be($user); // Mocks Auth::user with this user.

        $module = Module::findOrFail(
            DB::table('module_user')->where('module_role_id', '1')->select('module_id')->first()->module_id);

        $this->assertTrue(ModulePermission::permissionText($module, $user) == "Student");
    }

















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

        $this->assertTrue(ModulePermission::canEdit($exceptModules->first()));
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

        $this->assertTrue(ModulePermission::canEdit($module));
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

        $this->assertFalse(ModulePermission::canEdit($module));
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

        $this->assertFalse(ModulePermission::canEdit($module));
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

        $this->assertTrue(ModulePermission::canCreate());
    }

    /**
     * Tests that a non admin cant create.
     *
     * @return void
     */
    public function testAdminCantCreate()
    {
        $user = User::findOrFail("1"); // Gets root admin user.
        $this->be($user); // Mocks Auth::user with this user.

        $this->assertTrue(ModulePermission::canCreate());
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

        $this->assertTrue(ModulePermission::canDelete($exceptModules->first()));
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

        $this->assertTrue(ModulePermission::canDelete($module));
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

        $this->assertFalse(ModulePermission::canDelete($module));
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

        $this->assertFalse(ModulePermission::canDelete($module));
    }

    /**
     * Tests an admin can view a module.
     *
     * @return void
     */
    public function testAdminCanShow()
    {
        $user = User::findOrFail("1"); // Gets root admin user.
        $this->be($user); // Mocks Auth::user with this user.
        $module = Module::all()->first();
        $this->assertTrue(ModulePermission::canShow($module));
    }

    /**
     * Tests a non admin and non enrolled user can't view a given module.
     *
     * @return void
     */
    public function testNotAdminNotEnrolledCantShow()
    {
        $user = User::findOrFail("2");
        $this->be($user); // Mocks Auth::user with this user.

        // Gets a random module, the user is not apart of.
        $exceptModule = Module::all()->except($user->modules->pluck('id')->toArray())->first();

        $this->assertFalse(ModulePermission::canShow($exceptModule));
    }

    /**
     * Tests that a non admin can view a module they are in.
     *
     * @return void
     */
    public function testCanShow()
    {
        $user = User::findOrFail("2");
        $this->be($user); // Mocks Auth::user with this user.
        $this->assertTrue(ModulePermission::canShow($user->modules->first()));
    }
}