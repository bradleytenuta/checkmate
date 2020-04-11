<?php

namespace Tests\Unit\Utility;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Utility\Viewer;

class ViewerTest extends TestCase
{
    /**
     * Tests that the string is formatted correctly.
     *
     * @return void
     */
    public function testFormatLine()
    {
        $before = "\t\r\n";
        $after = "    ";
        $this->assertTrue(Viewer::formatLine($before) == $after);
    }

    /**
     * Tests that nothing happens to the string as it is already formatted.
     *
     * @return void
     */
    public function testFormatLineNoChange()
    {
        $before = "test";
        $this->assertTrue(Viewer::formatLine($before) == $before);
    }
}