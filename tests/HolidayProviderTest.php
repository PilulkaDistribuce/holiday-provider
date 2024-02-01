<?php

declare(strict_types=1);

namespace ProfiSmsPhpSender\Tests;

use DateTime;
use DateTimeImmutable;
use DateTimeInterface;
use HolidayProvider\HolidayProvider;
use HolidayProvider\HolidayProviderException;
use HolidayProvider\OpenDaysDTO;
use PHPUnit\Framework\TestCase;
use Yasumi\Holiday;
use Yasumi\Yasumi;

class HolidayProviderTest extends TestCase
{
    private HolidayProvider $holidayProviderCz;
    private HolidayProvider $holidayProviderSk;
    private HolidayProvider $holidayProviderRo;
    private HolidayProvider $holidayProviderAt;
    private HolidayProvider $holidayProviderHu;

    public function setUp(): void
    {
        $this->holidayProviderCz = new HolidayProvider(HolidayProvider::COUNTRY_CZ);
        $this->holidayProviderSk = new HolidayProvider(HolidayProvider::COUNTRY_SK);
        $this->holidayProviderRo = new HolidayProvider(HolidayProvider::COUNTRY_RO);
        $this->holidayProviderAt = new HolidayProvider(HolidayProvider::COUNTRY_AT);
        $this->holidayProviderHu = new HolidayProvider(HolidayProvider::COUNTRY_HU);
    }

    /**
     * @dataProvider provideWrongCountriesException
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
            '2021 saturday - day after new year' => [new DateTime('2021-01-02'), false],
            '2021 shifting easter green thursday' => [new DateTime('2021-04-01'), false],
            '2021 shifting easter monday' => [new DateTime('2021-04-05'), true],
            '2021 saint Stephen\'s day ' => [new DateTime('2021-12-26'), true],
            'no holiday saturday' => [new DateTime('2021-09-04'), false],
            'no holiday sunday' => [new DateTime('2021-09-05'), false],
            '2023 Saints Cyril and Methodius Day' => [new DateTime('2023-07-05'), true],
        ];
    }

    /**
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
     * @dataProvider provideIsSlovakHoliday
     */
    public function testIsHuHolidayInSlovakia(DateTime $dateTime, bool $expectedResult): void
    {
        $this->assertSame($expectedResult, $this->holidayProviderHu->isHoliday($dateTime));
    }

    /**
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

    /**
     * @dataProvider provideIsHungaryHoliday
     */
    public function testIsHungaryHoliday(DateTime $dateTime, bool $expectedResult): void
    {
        $this->assertSame($expectedResult, $this->holidayProviderHu->isHoliday($dateTime));
    }

    /**
     * @return array<string, array<DateTimeInterface|bool>>
     */
    public function provideIsHungaryHoliday(): array
    {
        return [
            '2023 Memorial day of the 1848 Revolution' => [new DateTime('2023-03-15'), true],
        ];
    }

    /**
     * @dataProvider provideIsAustriaHoliday
     */
    public function testIsAustriaHoliday(DateTime $dateTime, bool $expectedResult): void
    {
        $this->assertSame($expectedResult, $this->holidayProviderAt->isHoliday($dateTime));
    }

    /**
     * @dataProvider provideIsCzechHoliday
     */
    public function testIsCzHolidayInAustria(DateTime $dateTime, bool $expectedResult): void
    {
        $this->assertSame($expectedResult, $this->holidayProviderAt->isHoliday($dateTime));
    }

    /**
     * @return array<string, array<DateTimeInterface|bool>>
     */
    public function provideIsAustriaHoliday(): array
    {
        return [
            '2023 Epiphany' => [new DateTime('2023-01-06'), true],
        ];
    }

    public function scriptDownloadHolidaysFromYasumi(): void
    {
        foreach (range(2021, 2030) as $year) {
            $holidayDates = Yasumi::create('CzechRepublic', $year)->getHolidays();
            $holidayDates = array_map(function (Holiday $holiday): string {
                return '\''.$holiday->format('Y').' '.str_replace('\'', '\\\'', $holiday->getName())
                    .'\' => \''.$holiday->format('Y-m-d').'\','.PHP_EOL;
            }, $holidayDates);

            file_put_contents('data.txt', $holidayDates, FILE_APPEND);
        }
    }

    /**
     * @dataProvider provideDateTimeForIncrementedByHolidaysAndWeekends
     */
    public function testGetDateIncrementedByHolidaysAndWeekends(
        DateTimeInterface $dateTime,
        int $incrementByDays,
        DateTimeImmutable $expectedResult
    ): void {
        $this->assertEquals(
            $expectedResult,
            $this->holidayProviderCz->getDateIncrementedByHolidaysAndWeekends($dateTime, $incrementByDays)
        );
    }

    /**
     * @dataProvider provideDateTimeForIncrementedByHolidaysAndWeekendsToThePast
     */
    public function testGetDateIncrementedByHolidaysAndWeekendsToThePast(
        DateTimeInterface $dateTime,
        int $incrementByDays,
        DateTimeImmutable $expectedResult
    ): void {
        $this->assertEquals(
            $expectedResult,
            $this->holidayProviderCz->getDateIncrementedByHolidaysAndWeekendsToThePast($dateTime, $incrementByDays)
        );
    }

    public function provideDateTimeForIncrementedByHolidaysAndWeekends(): array
    {
        return [
            'weekend over new year' => [new DateTimeImmutable('2021-12-31'), 2, new DateTimeImmutable('2022-01-04')],
            '2023 workers day' => [new DateTimeImmutable('2023-04-30'), 3, new DateTimeImmutable('2023-05-04')],
            'max increment' => [new DateTimeImmutable('2023-04-30'), 99999, new DateTimeImmutable('2406-12-06')],
        ];
    }

    public function provideDateTimeForIncrementedByHolidaysAndWeekendsToThePast(): array
    {
        return [
            'weekend over new year' => [new DateTimeImmutable('2022-01-01'), 2, new DateTimeImmutable('2021-12-30')],
            '2023 workers day' => [new DateTimeImmutable('2023-04-30'), 3, new DateTimeImmutable('2023-04-26')],
            'max increment' => [new DateTimeImmutable('2023-04-30'), 99999, new DateTimeImmutable('1639-12-14')],
        ];
    }

    /**
     * @dataProvider provideDateTimeForIncrementedByHolidaysAndOpenDays
     */
    public function testGetDateIncrementedByHolidaysAndOpenDays(
        DateTimeInterface $dateTime,
        int $incrementByDays,
        OpenDaysDTO $openDays,
        DateTimeImmutable $expectedResult
    ): void {
        $this->assertEquals(
            $expectedResult,
            $this->holidayProviderCz->getDateIncrementedByHolidaysAndOpenDays(
                $dateTime,
                $incrementByDays,
                $openDays
            )
        );
    }

    public function provideDateTimeForIncrementedByHolidaysAndOpenDays(): array
    {
        return [
            'weekend over new year' => [
                new DateTimeImmutable('2021-12-31'),
                2,
                new OpenDaysDTO(),
                new DateTimeImmutable('2022-01-03'),
            ],
            '2023 workers day' => [
                new DateTimeImmutable('2023-04-30'),
                3,
                new OpenDaysDTO(false, false),
                new DateTimeImmutable('2023-05-05'),
            ],
            'one day opened' => [
                new DateTimeImmutable('2023-04-30'),
                9,
                new OpenDaysDTO(true, false, false, false, false, false, false),
                new DateTimeImmutable('2023-07-10'),
            ],
        ];
    }

    /**
     * @dataProvider provideDateTimeForExceptions
     */
    public function testGetDateIncrementedByHolidaysAndOpenDaysExceptions(
        DateTimeInterface $dateTime,
        int $incrementByDays,
        OpenDaysDTO $openDays,
    ): void {
        $this->expectException(HolidayProviderException::class);
        $this->holidayProviderCz->getDateIncrementedByHolidaysAndOpenDays(
            $dateTime,
            $incrementByDays,
            $openDays
        );
    }

    public function provideDateTimeForExceptions(): array
    {
        return [
            'zero days' => [
                new DateTimeImmutable('2023-04-30'),
                0,
                new OpenDaysDTO(),
            ],
            'negative days' => [
                new DateTimeImmutable('2023-04-30'),
                -9,
                new OpenDaysDTO(),
            ],
            'too long calculation' => [
                new DateTimeImmutable('2023-04-30'),
                123456,
                new OpenDaysDTO(),
            ],
        ];
    }

    public function testAllClosedDays(): void
    {
        $this->expectException(HolidayProviderException::class);
        new OpenDaysDTO(false, false, false, false, false, false, false);
    }
}
