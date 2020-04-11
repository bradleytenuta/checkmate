<?php

namespace Tests\Unit\Utility;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Utility\CourseworkType;

class CourseworkTypeTest extends TestCase
{
    /**
     * Tests that the right path for the coursework type is returned.
     *
     * @return void
     */
    public function testGetIconPath()
    {
        $this->assertTrue(CourseworkType::getIconPath(1) == "images/coursework-types/" . "Java" . ".png");
    }

    /**
     * Tests that the right name for the coursework type is returned.
     *
     * @return void
     */
    public function testGetName()
    {
        $this->assertTrue(CourseworkType::getName(1) == "Java");
    }

    /**
     * Tests that the right extension for the coursework type is returned.
     *
     * @return void
     */
    public function testGetFileExtension()
    {
        $this->assertTrue(CourseworkType::getTestFileExtension(1) == "java");
    }
}