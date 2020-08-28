<?php namespace Reviewsio\Test\Construction;

use Reviewsio\DateRange;
use Carbon\Carbon;
use \PHPUnit\Framework\TestCase;

class StaticHoursTest extends \PHPUnit\Framework\TestCase
{
    public function test_this_hour()
    {
        $range = DateRange::thisHour($expected_timezone = 'UTC');
        $expected_after = Carbon::now($expected_timezone)->startOfHour()->subMicrosecond();

        $this->assertInstanceOf(DateRange::class, $range);

        $after = $range->getAfter();
        $this->assertInstanceOf(Carbon::class, $range->getAfter());
        $this->assertEquals($expected_after, $range->getAfter());
        $this->assertEquals($expected_after->timezone, $after->timezone);

        $expected_before = Carbon::now($expected_timezone)->endOfHour()->addMicrosecond();
        $before = $range->getBefore();
        $this->assertEquals($expected_before, $range->getBefore());
        $this->assertEquals($expected_before, $before);
    }

    public function test_timezone_is_optional_for_thisHour()
    {
        $range = DateRange::thisHour();
        $expected_timezone = 'GB';
        $this->assertEquals($expected_timezone, $range->getAfter()->getTimezone());
        $this->assertEquals($expected_timezone, $range->getBefore()->getTimezone());
    }

    public function test_next_hour()
    {
        $range = DateRange::nextHour($expected_timezone = 'UTC');

        $this->assertInstanceOf(DateRange::class, $range);

        $expected_after = Carbon::now($expected_timezone)->startOfHour()->addHour()->subMicrosecond();
        $after = $range->getAfter();
        $this->assertInstanceOf(Carbon::class, $range->getAfter());
        $this->assertEquals($expected_after, $range->getAfter());
        $this->assertEquals($expected_after->timezone, $after->timezone);

        $expected_before = Carbon::now($expected_timezone)->endOfHour()->addHour()->addMicrosecond();
        $before = $range->getBefore();
        $this->assertEquals($expected_before, $range->getBefore());
        $this->assertEquals($expected_before, $before);
    }

    public function test_timezone_is_optional_for_nextHour()
    {
        $range = DateRange::nextHour();
        $expected_timezone = 'GB';
        $this->assertEquals($expected_timezone, $range->getAfter()->getTimezone());
        $this->assertEquals($expected_timezone, $range->getBefore()->getTimezone());
    }

    public function test_last_hour()
    {
        $range = DateRange::lastHour($expected_timezone = 'UTC');

        $this->assertInstanceOf(DateRange::class, $range);

        $expected_after = Carbon::now($expected_timezone)->subHour()->startOfHour()->subMicrosecond();
        $after = $range->getAfter();
        $this->assertInstanceOf(Carbon::class, $range->getAfter());
        $this->assertEquals($expected_after, $range->getAfter());
        $this->assertEquals($expected_after->timezone, $after->timezone);

        $expected_before = Carbon::now($expected_timezone)->subHour()->endOfHour()->addMicrosecond();
        $before = $range->getBefore();
        $this->assertEquals($expected_before, $range->getBefore());
        $this->assertEquals($expected_before, $before);
    }

    public function test_timezone_is_optional_for_lastHour()
    {
        $range = DateRange::lastHour();
        $expected_timezone = 'GB';
        $this->assertEquals($expected_timezone, $range->getAfter()->getTimezone());
        $this->assertEquals($expected_timezone, $range->getBefore()->getTimezone());
    }
}
