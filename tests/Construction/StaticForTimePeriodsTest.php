<?php

namespace Reviewsio\Test\Construction;

use Reviewsio\DateRange;
use Carbon\Carbon;
use \PHPUnit\Framework\TestCase;

class StaticForTimePeriodsTest extends \PHPUnit\Framework\TestCase
{
    public function test_for_month()
    {
        $expected_start = Carbon::now($expected_timezone = 'UTC')->startOfMonth();

        $range = DateRange::forMonth('Y-m-d', $expected_start->toDateString(), $expected_timezone);

        $this->assertInstanceOf(DateRange::class, $range);

        $expected_after = $expected_start->copy()->subSecond();
        $this->assertInstanceOf(Carbon::class, $range->getAfter());
        $this->assertEquals($expected_after, $range->getAfter());
        $this->assertEquals($expected_timezone, $range->getAfter()->getTimezone());

        $expected_before = $expected_start->copy()->endOfMonth()->addSecond();
        $this->assertInstanceOf(Carbon::class, $range->getBefore());
        $this->assertEquals($expected_before, $range->getBefore());
        $this->assertEquals($expected_timezone, $range->getBefore()->getTimezone());
    }

    public function test_timezone_is_optional_forMonth()
    {
        $expected_start = Carbon::now()->startOfMonth();
        $range = DateRange::forMonth('Y-m-d', $expected_start->toDateString());
        $expected_timezone = 'GB';
        $this->assertEquals($expected_timezone, $range->getAfter()->getTimezone());
        $this->assertEquals($expected_timezone, $range->getBefore()->getTimezone());
    }
}
