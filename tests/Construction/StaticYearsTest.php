<?php namespace Reviewsio\Test\Construction;

use Reviewsio\DateRange;
use Carbon\Carbon;
use \PHPUnit\Framework\TestCase;

class StaticYearsTest extends \PHPUnit\Framework\TestCase
{
    public function test_this_year()
    {
        $range = DateRange::thisYear($expected_timezone = 'UTC');

        $this->assertInstanceOf(DateRange::class, $range);

        $expected_start = Carbon::now($expected_timezone)->startOfYear();

        $expected_after = $expected_start->copy()->subSecond();
        $this->assertAttributeInstanceOf(Carbon::class, 'after', $range);
        $this->assertAttributeEquals($expected_after, 'after', $range);
        $this->assertAttributeEquals($expected_timezone, 'timezone', $range->getAfter());

        $expected_before = $expected_start->copy()->endOfYear()->addSecond();
        $this->assertAttributeInstanceOf(Carbon::class, 'before', $range);
        $this->assertAttributeEquals($expected_before, 'before', $range);
        $this->assertAttributeEquals($expected_timezone, 'timezone', $range->getBefore());
    }

    public function test_timezone_is_optional_for_thisYear()
    {
        $range = DateRange::thisYear();
        $expected_timezone = 'GB';
        $this->assertAttributeEquals($expected_timezone, 'timezone', $range->getAfter());
        $this->assertAttributeEquals($expected_timezone, 'timezone', $range->getBefore());
    }

    public function test_next_year()
    {
        $range = DateRange::nextYear($expected_timezone = 'UTC');

        $this->assertInstanceOf(DateRange::class, $range);

        $expected_start = Carbon::now($expected_timezone)->startOfYear()->addYear();

        $expected_after = $expected_start->copy()->subSecond();
        $this->assertAttributeInstanceOf(Carbon::class, 'after', $range);
        $this->assertAttributeEquals($expected_after, 'after', $range);
        $this->assertAttributeEquals($expected_timezone, 'timezone', $range->getAfter());

        $expected_before = $expected_start->copy()->endOfYear()->addSecond();
        $this->assertAttributeInstanceOf(Carbon::class, 'before', $range);
        $this->assertAttributeEquals($expected_before, 'before', $range);
        $this->assertAttributeEquals($expected_timezone, 'timezone', $range->getBefore());
    }

    public function test_timezone_is_optional_for_nextYear()
    {
        $range = DateRange::nextYear();
        $expected_timezone = 'GB';
        $this->assertAttributeEquals($expected_timezone, 'timezone', $range->getAfter());
        $this->assertAttributeEquals($expected_timezone, 'timezone', $range->getBefore());
    }

    public function test_last_year()
    {
        $range = DateRange::lastYear($expected_timezone = 'UTC');

        $this->assertInstanceOf(DateRange::class, $range);

        $expected_start = Carbon::now($expected_timezone)->startOfYear()->subYear();

        $expected_after = $expected_start->copy()->subSecond();
        $this->assertAttributeInstanceOf(Carbon::class, 'after', $range);
        $this->assertAttributeEquals($expected_after, 'after', $range);
        $this->assertAttributeEquals($expected_timezone, 'timezone', $range->getAfter());

        $expected_before = $expected_start->copy()->endOfYear()->addSecond();
        $this->assertAttributeInstanceOf(Carbon::class, 'before', $range);
        $this->assertAttributeEquals($expected_before, 'before', $range);
        $this->assertAttributeEquals($expected_timezone, 'timezone', $range->getBefore());
    }

    public function test_timezone_is_optional_for_lastYear()
    {
        $range = DateRange::lastYear();
        $expected_timezone = 'GB';
        $this->assertAttributeEquals($expected_timezone, 'timezone', $range->getAfter());
        $this->assertAttributeEquals($expected_timezone, 'timezone', $range->getBefore());
    }
}
