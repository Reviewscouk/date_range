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

        $expected_after = Carbon::now($expected_timezone)->minute(0)->second(0)->subSecond();
        $after = $range->getAfter();
        $this->assertAttributeInstanceOf(Carbon::class, 'after', $range);
        $this->assertAttributeEquals($expected_after, 'after', $range);
        $this->assertEquals($expected_after->timezone, $after->timezone);

        $expected_before = Carbon::now($expected_timezone)->endOfHour()->addMicrosecond();
        $before = $range->getBefore();
        $this->assertAttributeEquals($expected_before, 'before', $range);
        $this->assertEquals($expected_before, $before);
    }

    public function test_timezone_is_optional_for_thisHour()
    {
        $range = DateRange::thisHour();
        $expected_timezone = 'GB';
        $this->assertAttributeEquals($expected_timezone, 'timezone', $range->getAfter());
        $this->assertAttributeEquals($expected_timezone, 'timezone', $range->getBefore());
    }

    public function test_next_hour()
    {
        $range = DateRange::nextHour($expected_timezone = 'UTC');

        $this->assertInstanceOf(DateRange::class, $range);

        $expected_after = Carbon::now($expected_timezone)->startOfHour()->addHour()->subMicrosecond();
        $after = $range->getAfter();
        $this->assertAttributeInstanceOf(Carbon::class, 'after', $range);
        $this->assertAttributeEquals($expected_after, 'after', $range);
        $this->assertEquals($expected_after->timezone, $after->timezone);

        $expected_before = Carbon::now($expected_timezone)->endOfHour()->addHour()->addMicrosecond();
        $before = $range->getBefore();
        $this->assertAttributeEquals($expected_before, 'before', $range);
        $this->assertEquals($expected_before, $before);
    }

    public function test_timezone_is_optional_for_nextHour()
    {
        $range = DateRange::nextHour();
        $expected_timezone = 'GB';
        $this->assertAttributeEquals($expected_timezone, 'timezone', $range->getAfter());
        $this->assertAttributeEquals($expected_timezone, 'timezone', $range->getBefore());
    }

    public function test_last_hour()
    {
        $range = DateRange::lastHour($expected_timezone = 'UTC');

        $this->assertInstanceOf(DateRange::class, $range);

        $expected_after = Carbon::now($expected_timezone)->subHour()->startOfHour()->subMicrosecond();
        $after = $range->getAfter();
        $this->assertAttributeInstanceOf(Carbon::class, 'after', $range);
        $this->assertAttributeEquals($expected_after, 'after', $range);
        $this->assertEquals($expected_after->timezone, $after->timezone);

        $expected_before = Carbon::now($expected_timezone)->subHour()->endOfHour()->addMicrosecond();
        $before = $range->getBefore();
        $this->assertAttributeEquals($expected_before, 'before', $range);
        $this->assertEquals($expected_before, $before);
    }

    public function test_timezone_is_optional_for_lastHour()
    {
        $range = DateRange::lastHour();
        $expected_timezone = 'GB';
        $this->assertAttributeEquals($expected_timezone, 'timezone', $range->getAfter());
        $this->assertAttributeEquals($expected_timezone, 'timezone', $range->getBefore());
    }
}
