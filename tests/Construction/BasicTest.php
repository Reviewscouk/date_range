<?php

namespace Reviewsio\Test\Construction;

use Reviewsio\DateRange;
use Carbon\Carbon;
use PHPUnit\Framework\TestCase;

/**
 * Class ConstructorTest.
 */
class BasicTest extends TestCase
{
    /**
     * @inherit
     */
    public function setUp(): void
    {
        parent::setUp();

        Carbon::setTestNow();
    }

    public function testBasicConstruction()
    {
        new DateRange(
            Carbon::today()->subSecond(),
            Carbon::today()->endOfDay()->addSecond()
        );
    }

    /**
     * @expectedException \Reviewsio\Exceptions\TimezoneException
     */
    public function testTimezoneExceptionThrownIfDateRangeConstructedWithMultipleTimezones()
    {
        $timezone_1 = 'GB';
        $timezone_2 = null;

        new DateRange(
            Carbon::today($timezone_1)->subSecond(),
            Carbon::today($timezone_2)->endOfDay()->addSecond()
        );
    }

    /**
     * @expectedException \Reviewsio\Exceptions\DateRangeException
     */
    public function testDateTimeExceptionThrownIfDateRangeConstructedWithoutDates()
    {
        new DateRange();
    }

    public function testTimezoneIsInitialisedWithBothDatesProvided()
    {
        $timezone = 'GB';

        $range = new DateRange(
            Carbon::today($timezone)->subSecond(),
            Carbon::today($timezone)->endOfDay()->addSecond()
        );

        $this->assertEquals($timezone, $range->getTimezone()->getName());
    }

    public function testAfterDateIsInitialisedWithBothDatesProvided()
    {
        $range = new DateRange(
            $expected = Carbon::today()->subSecond(),
            Carbon::today()->endOfDay()->addSecond()
        );

        $this->assertEquals($expected, $range->getAfter());
    }

    public function testBeforeDateIsInitialisedWithBothDatesProvided()
    {
        $range = new DateRange(
            Carbon::today()->subSecond(),
            $expected = Carbon::today()->endOfDay()->addSecond()
        );

        $this->assertEquals($expected, $range->getBefore());
    }

    public function testTimezoneIsInitialisedWithoutAfterDate()
    {
        $range = new DateRange(null, Carbon::today($expected = 'GB')->endOfDay()->addSecond());

        $this->assertEquals($expected, $range->getTimezone()->getName());
    }

    public function testAfterDateIsInitialisedWithoutAfterDate()
    {
        $range = new DateRange($expected = null, Carbon::today()->endOfDay()->addSecond());

        $this->assertEquals($expected, $range->getAfter());
    }

    public function testBeforeDateIsInitialisedWithoutAfterDate()
    {
        $range = new DateRange(null, $expected = Carbon::today()->endOfDay()->addSecond());

        $this->assertEquals($expected, $range->getBefore());
    }

    public function testTimezoneIsInitialisedWithoutBeforeDate()
    {
        $range = new DateRange(Carbon::today($expected = 'GB')->subSecond(), null);

        $this->assertEquals($expected, $range->getTimezone()->getName());
    }

    public function testAfterDateIsInitialisedWithoutBeforeDate()
    {
        $range = new DateRange($expected = Carbon::today()->subSecond(), null);

        $this->assertEquals($expected, $range->getAfter());
    }

    public function testBeforeDateIsInitialisedWithoutBeforeDate()
    {
        $range = new DateRange(Carbon::today()->subSecond(), $expected = null);

        $this->assertEquals($expected, $range->getBefore());
    }
}
