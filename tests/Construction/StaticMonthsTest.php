<?php namespace Reviewsio\Test\Construction;

use Reviewsio\DateRange;
use Carbon\Carbon;
use \PHPUnit\Framework\TestCase;

class StaticMonthsTest extends \PHPUnit\Framework\TestCase
{
    public function test_this_month()
    {
        $range = DateRange::thisMonth($expected_timezone = 'UTC');

        $this->assertInstanceOf(DateRange::class, $range);

        $expected_start = Carbon::now($expected_timezone)->startOfMonth();

        $expected_after = $expected_start->copy()->subSecond();
        $this->assertInstanceOf(Carbon::class, $range->getAfter());
        $this->assertEquals($expected_after, $range->getAfter());
        $this->assertEquals($expected_timezone, $range->getAfter()->getTimezone());

        $expected_before = $expected_start->copy()->endOfMonth()->addSecond();
        $this->assertInstanceOf(Carbon::class, $range->getBefore());
        $this->assertEquals($expected_before, $range->getBefore());
        $this->assertEquals($expected_timezone, $range->getBefore()->getTimezone());
    }

    public function test_timezone_is_optional_for_thisMonth()
    {
        $range = DateRange::thisMonth();
        $expected_timezone = 'GB';
        $this->assertEquals($expected_timezone, $range->getAfter()->getTimezone());
        $this->assertEquals($expected_timezone, $range->getBefore()->getTimezone());
    }

    public function test_next_month()
    {
        $range = DateRange::nextMonth($expected_timezone = 'UTC');

        $this->assertInstanceOf(DateRange::class, $range);

        $expected_start = Carbon::now($expected_timezone)->startOfMonth()->addMonth();

        $expected_after = $expected_start->copy()->subSecond();
        $this->assertInstanceOf(Carbon::class, $range->getAfter());
        $this->assertEquals($expected_after, $range->getAfter());
        $this->assertEquals($expected_timezone, $range->getAfter()->getTimezone());

        $expected_before = $expected_start->copy()->endOfMonth()->addSecond();
        $this->assertInstanceOf(Carbon::class, $range->getBefore());
        $this->assertEquals($expected_before, $range->getBefore());
        $this->assertEquals($expected_timezone, $range->getBefore()->getTimezone());
    }

    public function test_timezone_is_optional_for_nextMonth()
    {
        $range = DateRange::nextMonth();
        $expected_timezone = 'GB';
        $this->assertEquals($expected_timezone, $range->getAfter()->getTimezone());
        $this->assertEquals($expected_timezone, $range->getBefore()->getTimezone());
    }

    public function test_last_month()
    {
        $range = DateRange::lastMonth($expected_timezone = 'UTC');

        $this->assertInstanceOf(DateRange::class, $range);

        $expected_start = Carbon::now($expected_timezone)->startOfMonth()->subMonth();

        $expected_after = $expected_start->copy()->subSecond();
        $this->assertInstanceOf(Carbon::class, $range->getAfter());
        $this->assertEquals($expected_after, $range->getAfter());
        $this->assertEquals($expected_timezone, $range->getAfter()->getTimezone());

        $expected_before = $expected_start->copy()->endOfMonth()->addSecond();
        $this->assertInstanceOf(Carbon::class, $range->getBefore());
        $this->assertEquals($expected_before, $range->getBefore());
        $this->assertEquals($expected_timezone, $range->getBefore()->getTimezone());
    }

    public function test_timezone_is_optional_for_lastMonth()
    {
        $range = DateRange::lastMonth();
        $expected_timezone = 'GB';
        $this->assertEquals($expected_timezone, $range->getAfter()->getTimezone());
        $this->assertEquals($expected_timezone, $range->getBefore()->getTimezone());
    }
}
