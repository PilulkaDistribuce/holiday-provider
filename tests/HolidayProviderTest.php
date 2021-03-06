<?php

declare(strict_types=1);

namespace ProfiSmsPhpSender\Tests;

use DateTime;
use DateTimeInterface;
use HolidayProvider\HolidayProvider;
use HolidayProvider\HolidayProviderException;
use PHPUnit\Framework\TestCase;
use Yasumi\Holiday;
use Yasumi\Yasumi;

class HolidayProviderTest extends TestCase
{
    /** @var HolidayProvider */
    private $holidayProviderCz;

    /** @var HolidayProvider */
    private $holidayProviderSk;

    /** @var HolidayProvider */
    private $holidayProviderRo;

    /**
     * @return void
     */
    public function setUp()
    {
        $this->holidayProviderCz = new HolidayProvider(HolidayProvider::COUNTRY_CZ);
        $this->holidayProviderSk = new HolidayProvider(HolidayProvider::COUNTRY_SK);
        $this->holidayProviderRo = new HolidayProvider(HolidayProvider::COUNTRY_RO);
    }

    /**
     * @param string $country
     * @param string $expectedExceptionClass
     *
     * @dataProvider provideWrongCountriesException
     * @throws HolidayProviderException
     */
    public function testWrongCountriesException(string $country, string $expectedExceptionClass): void
    {
        $this->expectException($expectedExceptionClass);
        new HolidayProvider($country);
    }

    /**
     * @return string[][]
     */
    public function provideWrongCountriesException(): array
    {
        return [
            'unknown' => ['xy', HolidayProviderException::class],
            'not implemented' => ['fr', HolidayProviderException::class],
            'local language' => ['Česko', HolidayProviderException::class],
            'mixed capitals' => ['Sk', HolidayProviderException::class],
        ];
    }

    /**
     * @param DateTime $dateTime
     * @param bool $expectedResult
     *
     * @dataProvider provideIsCzechHoliday
     */
    public function testIsCzechHoliday(DateTime $dateTime, bool $expectedResult): void
    {
        $this->assertSame($expectedResult, $this->holidayProviderCz->isHoliday($dateTime));
    }

    /**
     * @return array<string, array<DateTimeInterface|bool>>
     */
    public function provideIsCzechHoliday(): array
    {
        return [
            '2021 friday new year' => [new DateTime('2021-01-01'), true],
            '2021 saturay - day after new year' => [new DateTime('2021-01-02'), false],
            '2021 shifting easter green thursday' => [new DateTime('2021-04-01'), false],
            '2021 shifting easter monday' => [new DateTime('2021-04-05'), true],
            '2021 saint Stephen\'s day ' => [new DateTime('2021-12-26'), true],
            '2021 New Years Eve' => [new DateTime('2021-12-31'), false],
            'no holiday saturday' => [new DateTime('2021-09-04'), false],
            'no holiday sunday' => [new DateTime('2021-09-05'), false],
        ];
    }

    /**
     * @param DateTime $dateTime
     * @param bool $expectedResult
     *
     * @dataProvider provideIsWeekendOrHoliday
     */
    public function testIsWeekendOrHoliday(DateTime $dateTime, bool $expectedResult): void
    {
        $this->assertSame($expectedResult, $this->holidayProviderCz->isWeekendOrHoliday($dateTime));
    }

    /**
     * @return array<string, array<DateTimeInterface|bool>>
     */
    public function provideIsWeekendOrHoliday(): array
    {
        return [
            '2021 friday new year' => [new DateTime('2021-01-01'), true],
            '2021 monday after new year' => [new DateTime('2021-01-04'), false],
            'saturday' => [new DateTime('2021-09-04'), true],
            'sunday' => [new DateTime('2021-09-05'), true],
        ];
    }

    /**
     * @param DateTime $dateTime
     * @param bool $expectedResult
     *
     * @dataProvider provideIsSlovakHoliday
     */
    public function testIsSlovakHoliday(DateTime $dateTime, bool $expectedResult): void
    {
        $this->assertSame($expectedResult, $this->holidayProviderSk->isHoliday($dateTime));
    }

    /**
     * @return array<string, array<DateTimeInterface|bool>>
     */
    public function provideIsSlovakHoliday(): array
    {
        return [
            '2021 friday new year' => [new DateTime('2021-01-01'), true],
            '2021 saturay - day after new year' => [new DateTime('2021-01-02'), false],
            '2021 shifting easter green thursday' => [new DateTime('2021-04-01'), false],
            '2021 shifting easter monday' => [new DateTime('2021-04-05'), true],
            '2021 saint Stephen\'s day' => [new DateTime('2021-12-26'), true],
            '2021 New Years Eve' => [new DateTime('2021-12-31'), true],
            'no holiday saturday' => [new DateTime('2021-09-04'), false],
            'no holiday sunday' => [new DateTime('2021-09-05'), false],
        ];
    }

    /**
     * @param DateTime $dateTime
     * @param bool $expectedResult
     *
     * @dataProvider provideIsRomaniaHoliday
     */
    public function testIsRomaniaHoliday(DateTime $dateTime, bool $expectedResult): void
    {
        $this->assertSame($expectedResult, $this->holidayProviderRo->isHoliday($dateTime));
    }

    /**
     * @return array<string, array<DateTimeInterface|bool>>
     */
    public function provideIsRomaniaHoliday(): array
    {
        return [
            '2021 friday new year' => [new DateTime('2021-01-01'), true],
            '2021 union day' => [new DateTime('2021-01-24'), true],
            '2021 father\'s day' => [new DateTime('2021-05-09'), false],
            '2021 great union day' => [new DateTime('2021-12-01'), true],
            'no holiday saturday' => [new DateTime('2021-09-04'), false],
            'no holiday sunday' => [new DateTime('2021-09-05'), false],
        ];
    }

    public function scriptDownloadHolidaysFromYasumi(): void
    {
        foreach (range(2021, 2030) as $year) {
            $holidayDates = Yasumi::create('Slovakia', $year)->getHolidays();
            var_dump($holidayDates);
            $holidayDates = array_map(function (Holiday $holiday): string {
                return '\''.$holiday->format('Y').' '.str_replace('\'', '\\\'', $holiday->getName())
                    .'\' => \''.$holiday->format('Y-m-d').'\','.PHP_EOL;
            }, $holidayDates);

            file_put_contents('data.txt', $holidayDates, FILE_APPEND);
        }
    }
}
