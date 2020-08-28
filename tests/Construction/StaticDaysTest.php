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
        $this->assertAttributeInstanceOf(Carbon::class, 'after', $range);
        $this->assertAttributeEquals($expectedAfter, 'after', $range);
        $this->assertAttributeEquals($expectedTimezone, 'timezone', $range->getAfter());

        $expectedBefore = Carbon::now($expectedTimezone)->endOfDay()->addSecond();
        $this->assertAttributeInstanceOf(Carbon::class, 'before', $range);
        $this->assertAttributeEquals($expectedBefore, 'before', $range);
        $this->assertAttributeEquals($expectedTimezone, 'timezone', $range->getBefore());
    }

    public function testTimezoneIsOptionalForToday()
    {
        $range = DateRange::today();
        $expectedTimezone = 'GB';
        $this->assertAttributeEquals($expectedTimezone, 'timezone', $range->getAfter());
        $this->assertAttributeEquals($expectedTimezone, 'timezone', $range->getBefore());
    }

    public function testTomorrow()
    {
        $range = DateRange::tomorrow($expectedTimezone = 'UTC');

        $this->assertInstanceOf(DateRange::class, $range);

        $tomorrow = Carbon::now($expectedTimezone)->startOfDay()->addDay();

        $expectedAfter = $tomorrow->copy()->subSecond();
        $this->assertAttributeInstanceOf(Carbon::class, 'after', $range);
        $this->assertAttributeEquals($expectedAfter, 'after', $range);
        $this->assertAttributeEquals($expectedTimezone, 'timezone', $range->getAfter());

        $expectedBefore = $tomorrow->copy()->endOfDay()->addSecond();
        $this->assertAttributeInstanceOf(Carbon::class, 'before', $range);
        $this->assertAttributeEquals($expectedBefore, 'before', $range);
        $this->assertAttributeEquals($expectedTimezone, 'timezone', $range->getBefore());
    }

    public function testTimezoneIsOptionalForTomorrow()
    {
        $range = DateRange::tomorrow();
        $expectedTimezone = 'GB';
        $this->assertAttributeEquals($expectedTimezone, 'timezone', $range->getAfter());
        $this->assertAttributeEquals($expectedTimezone, 'timezone', $range->getBefore());
    }

    public function testYesterday()
    {
        $range = DateRange::yesterday($expectedTimezone = 'UTC');

        $this->assertInstanceOf(DateRange::class, $range);

        $yesterday = Carbon::now($expectedTimezone)->startOfDay()->subDay();

        $expectedAfter = $yesterday->copy()->subSecond();
        $this->assertAttributeInstanceOf(Carbon::class, 'after', $range);
        $this->assertAttributeEquals($expectedAfter, 'after', $range);
        $this->assertAttributeEquals($expectedTimezone, 'timezone', $range->getAfter());

        $expectedBefore = $yesterday->copy()->endOfDay()->addSecond();
        $this->assertAttributeInstanceOf(Carbon::class, 'before', $range);
        $this->assertAttributeEquals($expectedBefore, 'before', $range);
        $this->assertAttributeEquals($expectedTimezone, 'timezone', $range->getBefore());
    }

    public function testTimezoneIsOptionalForYesterday()
    {
        $range = DateRange::yesterday();
        $expectedTimezone = 'GB';
        $this->assertAttributeEquals($expectedTimezone, 'timezone', $range->getAfter());
        $this->assertAttributeEquals($expectedTimezone, 'timezone', $range->getBefore());
    }
}
