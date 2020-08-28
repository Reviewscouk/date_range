<?php namespace Reviewsio\Test;

use Reviewsio\DateRange;
use Carbon\Carbon;
use \PHPUnit\Framework\TestCase;

class StaticDaysTest extends \PHPUnit\Framework\TestCase
{
    public function testToday()
    {
        $range = DateRange::today($expectedTimezone = 'UTC');

        $this->assertInstanceOf(DateRange::class, $range);

        $expectedAfter = Carbon::now($expectedTimezone)->startOfDay()->subSecond();
        $this->assertInstanceOf(Carbon::class, $range->getAfter());
        $this->assertEquals($expectedAfter, $range->getAfter());
        $this->assertEquals($expectedTimezone, $range->getAfter()->getTimezone());

        $expectedBefore = Carbon::now($expectedTimezone)->endOfDay()->addSecond();
        $this->assertInstanceOf(Carbon::class, $range->getBefore());
        $this->assertEquals($expectedBefore, $range->getBefore());
        $this->assertEquals($expectedTimezone, $range->getBefore()->getTimezone());
    }

    public function testTimezoneIsOptionalForToday()
    {
        $range = DateRange::today();
        $expectedTimezone = 'GB';
        $this->assertEquals($expectedTimezone, $range->getAfter()->getTimezone());
        $this->assertEquals($expectedTimezone, $range->getBefore()->getTimezone());
    }

    public function testTomorrow()
    {
        $range = DateRange::tomorrow($expectedTimezone = 'UTC');

        $this->assertInstanceOf(DateRange::class, $range);

        $tomorrow = Carbon::now($expectedTimezone)->startOfDay()->addDay();

        $expectedAfter = $tomorrow->copy()->subSecond();
        $this->assertInstanceOf(Carbon::class, $range->getAfter());
        $this->assertEquals($expectedAfter, $range->getAfter());
        $this->assertEquals($expectedTimezone, $range->getAfter()->getTimezone());

        $expectedBefore = $tomorrow->copy()->endOfDay()->addSecond();
        $this->assertInstanceOf(Carbon::class, $range->getBefore());
        $this->assertEquals($expectedBefore, $range->getBefore());
        $this->assertEquals($expectedTimezone, $range->getBefore()->getTimezone());
    }

    public function testTimezoneIsOptionalForTomorrow()
    {
        $range = DateRange::tomorrow();
        $expectedTimezone = 'GB';
        $this->assertEquals($expectedTimezone, $range->getAfter()->getTimezone());
        $this->assertEquals($expectedTimezone, $range->getBefore()->getTimezone());
    }

    public function testYesterday()
    {
        $range = DateRange::yesterday($expectedTimezone = 'UTC');

        $this->assertInstanceOf(DateRange::class, $range);

        $yesterday = Carbon::now($expectedTimezone)->startOfDay()->subDay();

        $expectedAfter = $yesterday->copy()->subSecond();
        $this->assertInstanceOf(Carbon::class, $range->getAfter());
        $this->assertEquals($expectedAfter, $range->getAfter());
        $this->assertEquals($expectedTimezone, $range->getAfter()->getTimezone());

        $expectedBefore = $yesterday->copy()->endOfDay()->addSecond();
        $this->assertInstanceOf(Carbon::class, $range->getBefore());
        $this->assertEquals($expectedBefore, $range->getBefore());
        $this->assertEquals($expectedTimezone, $range->getBefore()->getTimezone());
    }

    public function testTimezoneIsOptionalForYesterday()
    {
        $range = DateRange::yesterday();
        $expectedTimezone = 'GB';
        $this->assertEquals($expectedTimezone, $range->getAfter()->getTimezone());
        $this->assertEquals($expectedTimezone, $range->getBefore()->getTimezone());
    }
}
