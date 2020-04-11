<?php

namespace Tests\Unit\App;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\ModelCreator;

class ModuleTest extends TestCase
{
    /**
     * Tests that all the courseworks it returns are open.
     *
     * @return void
     */
    public function testOpenCourseworksValid()
    {
        $module = ModelCreator::createModule(2, 0, 0);
        $this->assertTrue(count($module->openCourseworks()) == 2);
    }

    /**
     * Tests that if there is no open courseworks, it returns 0.
     *
     * @return void
     */
    public function testOpenCourseworksIsZero()
    {
        $module = ModelCreator::createModule(0, 0, 0);
        $this->assertTrue(count($module->openCourseworks()) == 0);
    }

    /**
     * Tests that all the courseworks it returns are closed.
     *
     * @return void
     */
    public function testClosedCourseworksValid()
    {
        $module = ModelCreator::createModule(0, 0, 2);
        $this->assertTrue(count($module->closedCourseworks()) == 2);
    }

    /**
     * Tests that if there is no closed courseworks, it returns 0.
     *
     * @return void
     */
    public function testClosedCourseworksIsZero()
    {
        $module = ModelCreator::createModule(0, 0, 0);
        $this->assertTrue(count($module->closedCourseworks()) == 0);
    }

    /**
     * Tests that all the courseworks it returns are pending.
     *
     * @return void
     */
    public function testPendingCourseworksValid()
    {
        $module = ModelCreator::createModule(0, 2, 0);
        $this->assertTrue(count($module->pendingCourseworks()) == 2);
    }

    /**
     * Tests that if there is no pending courseworks, it returns 0.
     *
     * @return void
     */
    public function testPendingCourseworksIsZero()
    {
        $module = ModelCreator::createModule(0, 0, 0);
        $this->assertTrue(count($module->pendingCourseworks()) == 0);
    }

    /**
     * Tests that if there is pending courseworks and closed ones, it can pull the pending ones out.
     *
     * @return void
     */
    public function testPendingCourseworksWithSomeClosed()
    {
        $module = ModelCreator::createModule(0, 4, 3);
        $this->assertTrue(count($module->pendingCourseworks()) == 4);
    }
}