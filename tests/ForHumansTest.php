<?php

namespace Reviewsio\Test;

use Reviewsio\DateRange;
use Carbon\Carbon;
use PHPUnit\Framework\TestCase;

/**
 * Class ForHumansTest.
 */
class ForHumansTest extends \PHPUnit\Framework\TestCase
{
    public function testToday()
    {
        $range = new DateRange(
            Carbon::today()->subSecond(),
            Carbon::today()->endOfDay()->addSecond()
        );

        $expectedResult = 'Today';

        $this->assertEquals($expectedResult, $range->forHumans());
    }

    public function testTomorrow()
    {
        $range = new DateRange(
            Carbon::tomorrow('GB')->startOfDay()->subSecond(),
            Carbon::tomorrow('GB')->endOfDay()->addSecond()
        );

        $expectedResult = 'Tomorrow';

        $this->assertEquals($expectedResult, $range->forHumans());
    }

    public function testYesterday()
    {
        $range = new DateRange(
            Carbon::yesterday()->subSecond(),
            Carbon::yesterday()->endOfDay()->addSecond()
        );

        $expectedResult = 'Yesterday';

        $this->assertEquals($expectedResult, $range->forHumans());
    }

    public function testOtherDayInCurrentWeek()
    {
    }

    public function testOtherDayInLastWeek()
    {
    }

    public function testOtherDayInNextWeek()
    {
    }

    public function testOtherDay()
    {
    }

    public function testThisWeek()
    {
    }

    public function testNextWeek()
    {
    }

    public function testLastWeek()
    {
    }

    public function testOtherWeek()
    {
    }

    public function testThisMonth()
    {
    }

    public function testNextMonth()
    {
    }

    public function testLastMonth()
    {
    }

    public function testOtherMonth()
    {
    }

    public function testThisYear()
    {
    }

    public function testNextYear()
    {
    }

    public function testLastYear()
    {
    }

    public function testOtherYear()
    {
    }
}
