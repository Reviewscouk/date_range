<?php namespace Reviewsio\Test\Construction;

use Reviewsio\DateRange;
use Carbon\Carbon;
use \PHPUnit\Framework\TestCase;

class StaticWeeksTest extends \PHPUnit\Framework\TestCase
{
    public function test_this_week()
    {
        $range = DateRange::thisWeek($expected_timezone = 'UTC');

        $this->assertInstanceOf(DateRange::class, $range);

        $expected_start = Carbon::now($expected_timezone)->startOfWeek();

        $expected_after = $expected_start->copy()->subSecond();
        $this->assertInstanceOf(Carbon::class, $range->getAfter());
        $this->assertEquals($expected_after, $range->getAfter());
        $this->assertEquals($expected_timezone, $range->getAfter()->getTimezone());

        $expected_before = $expected_start->copy()->endOfWeek()->addSecond();
        $this->assertInstanceOf(Carbon::class, $range->getBefore());
        $this->assertEquals($expected_before, $range->getBefore());
        $this->assertEquals($expected_timezone, $range->getBefore()->getTimezone());
    }

    public function test_timezone_is_optional_for_thisWeek()
    {
        $range = DateRange::thisWeek();
        $expected_timezone = 'GB';
        $this->assertEquals($expected_timezone, $range->getAfter()->getTimezone());
        $this->assertEquals($expected_timezone, $range->getBefore()->getTimezone());
    }

    public function test_next_week()
    {
        $range = DateRange::nextWeek($expected_timezone = 'UTC');

        $this->assertInstanceOf(DateRange::class, $range);

        $expected_start = Carbon::now($expected_timezone)->startOfWeek()->addWeek();

        $expected_after = $expected_start->copy()->subSecond();
        $this->assertInstanceOf(Carbon::class, $range->getAfter());
        $this->assertEquals($expected_after, $range->getAfter());
        $this->assertEquals($expected_timezone, $range->getAfter()->getTimezone());

        $expected_before = $expected_start->copy()->endOfWeek()->addSecond();
        $this->assertInstanceOf(Carbon::class, $range->getBefore());
        $this->assertEquals($expected_before, $range->getBefore());
        $this->assertEquals($expected_timezone, $range->getBefore()->getTimezone());
    }

    public function test_timezone_is_optional_for_nextWeek()
    {
        $range = DateRange::nextWeek();
        $expected_timezone = 'GB';
        $this->assertEquals($expected_timezone, $range->getAfter()->getTimezone());
        $this->assertEquals($expected_timezone, $range->getBefore()->getTimezone());
    }

    public function test_last_week()
    {
        $range = DateRange::lastWeek($expected_timezone = 'UTC');

        $this->assertInstanceOf(DateRange::class, $range);

        $expected_start = Carbon::now($expected_timezone)->startOfWeek()->subWeek();

        $expected_after = $expected_start->copy()->subSecond();
        $this->assertInstanceOf(Carbon::class, $range->getAfter());
        $this->assertEquals($expected_after, $range->getAfter());
        $this->assertEquals($expected_timezone, $range->getAfter()->getTimezone());

        $expected_before = $expected_start->copy()->endOfWeek()->addSecond();
        $this->assertInstanceOf(Carbon::class, $range->getBefore());
        $this->assertEquals($expected_before, $range->getBefore());
        $this->assertEquals($expected_timezone, $range->getBefore()->getTimezone());
    }

    public function test_timezone_is_optional_for_lastWeek()
    {
        $range = DateRange::lastWeek();
        $expected_timezone = 'GB';
        $this->assertEquals($expected_timezone, $range->getAfter()->getTimezone());
        $this->assertEquals($expected_timezone, $range->getBefore()->getTimezone());
    }
}
