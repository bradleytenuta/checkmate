<?php

namespace Tests\Unit\App\Utility;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Utility\Time;
use App\Coursework;
use DateTime;

class TimeTest extends TestCase
{
    /**
     * Tests that the coursework start is in the future.
     *
     * @return void
     */
    public function testDateInFuture()
    {
        $coursework = Coursework::where("start_date", ">", new DateTime())->first();
        $this->assertTrue(Time::dateInFuture($coursework));
    }

    /**
     * Tests that the coursework start is not the future.
     *
     * @return void
     */
    public function testDateNotInFuture()
    {
        $coursework = Coursework::where("start_date", "<", new DateTime())->first();
        $this->assertFalse(Time::dateInFuture($coursework));
    }

    /**
     * Tests that the coursework deadline is not today.
     *
     * @return void
     */
    public function testDateIsNotToday()
    {
        $coursework = Coursework::where("start_date", ">", new DateTime())->first();
        $this->assertFalse(Time::dateIsToday($coursework));
    }

    /**
     * Tests that the coursework deadline has passed.
     *
     * @return void
     */
    public function testDateHasPassed()
    {
        $coursework = Coursework::where("deadline", "<", new DateTime())->first();
        $this->assertTrue(Time::dateHasPassed($coursework));
    }

    /**
     * Tests that the coursework deadline has not passed.
     *
     * @return void
     */
    public function testDateHasNotPassed()
    {
        $coursework = Coursework::where("deadline", ">", new DateTime())->first();
        $this->assertFalse(Time::dateHasPassed($coursework));
    }
}