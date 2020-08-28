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
        $this->assertAttributeInstanceOf(Carbon::class, 'after', $range);
        $this->assertAttributeEquals($expected_after, 'after', $range);
        $this->assertAttributeEquals($expected_timezone, 'timezone', $range->getAfter());

        $expected_before = $expected_start->copy()->endOfWeek()->addSecond();
        $this->assertAttributeInstanceOf(Carbon::class, 'before', $range);
        $this->assertAttributeEquals($expected_before, 'before', $range);
        $this->assertAttributeEquals($expected_timezone, 'timezone', $range->getBefore());
    }

    public function test_timezone_is_optional_for_thisWeek()
    {
        $range = DateRange::thisWeek();
        $expected_timezone = 'GB';
        $this->assertAttributeEquals($expected_timezone, 'timezone', $range->getAfter());
        $this->assertAttributeEquals($expected_timezone, 'timezone', $range->getBefore());
    }

    public function test_next_week()
    {
        $range = DateRange::nextWeek($expected_timezone = 'UTC');

        $this->assertInstanceOf(DateRange::class, $range);

        $expected_start = Carbon::now($expected_timezone)->startOfWeek()->addWeek();

        $expected_after = $expected_start->copy()->subSecond();
        $this->assertAttributeInstanceOf(Carbon::class, 'after', $range);
        $this->assertAttributeEquals($expected_after, 'after', $range);
        $this->assertAttributeEquals($expected_timezone, 'timezone', $range->getAfter());

        $expected_before = $expected_start->copy()->endOfWeek()->addSecond();
        $this->assertAttributeInstanceOf(Carbon::class, 'before', $range);
        $this->assertAttributeEquals($expected_before, 'before', $range);
        $this->assertAttributeEquals($expected_timezone, 'timezone', $range->getBefore());
    }

    public function test_timezone_is_optional_for_nextWeek()
    {
        $range = DateRange::nextWeek();
        $expected_timezone = 'GB';
        $this->assertAttributeEquals($expected_timezone, 'timezone', $range->getAfter());
        $this->assertAttributeEquals($expected_timezone, 'timezone', $range->getBefore());
    }

    public function test_last_week()
    {
        $range = DateRange::lastWeek($expected_timezone = 'UTC');

        $this->assertInstanceOf(DateRange::class, $range);

        $expected_start = Carbon::now($expected_timezone)->startOfWeek()->subWeek();

        $expected_after = $expected_start->copy()->subSecond();
        $this->assertAttributeInstanceOf(Carbon::class, 'after', $range);
        $this->assertAttributeEquals($expected_after, 'after', $range);
        $this->assertAttributeEquals($expected_timezone, 'timezone', $range->getAfter());

        $expected_before = $expected_start->copy()->endOfWeek()->addSecond();
        $this->assertAttributeInstanceOf(Carbon::class, 'before', $range);
        $this->assertAttributeEquals($expected_before, 'before', $range);
        $this->assertAttributeEquals($expected_timezone, 'timezone', $range->getBefore());
    }

    public function test_timezone_is_optional_for_lastWeek()
    {
        $range = DateRange::lastWeek();
        $expected_timezone = 'GB';
        $this->assertAttributeEquals($expected_timezone, 'timezone', $range->getAfter());
        $this->assertAttributeEquals($expected_timezone, 'timezone', $range->getBefore());
    }
}
