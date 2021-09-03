<?php

declare(strict_types=1);

namespace HolidayProvider;

use DateTimeInterface;
use Yasumi\Yasumi;

class HolidayProvider
{
    public const COUNTRY_CZ = 'cz';
    public const COUNTRY_SK = 'sk';
    public const COUNTRY_RO = 'ro';

    public const COUNTRIES = [
        self::COUNTRY_CZ,
        self::COUNTRY_SK,
        self::COUNTRY_RO,
    ];
    /** @var string */
    private $country;

    /**
     * @param string $country
     * @throws HolidayProviderException
     */
    public function __construct(string $country)
    {
        if (!in_array($country, self::COUNTRIES)) {
            throw new HolidayProviderException('country '.$country.' is not supported');
        }
        
        $this->country = $country;
    }

    public function isHoliday(DateTimeInterface $dateTime): bool
    {
        $localeMapper = [
            self::COUNTRY_CZ => 'CzechRepublic',
            self::COUNTRY_SK => 'Slovakia',
            self::COUNTRY_RO => 'Romania',
        ];

        $provider = Yasumi::create($localeMapper[$this->country], (int)$dateTime->format('Y'));
        
        return $provider->isHoliday($dateTime);
    }

    public function isWeekendOrHoliday(DateTimeInterface $dateTime): bool
    {
        $dayOfTheWeek = $dateTime->format('N');
        if ($dayOfTheWeek === '6' || $dayOfTheWeek === '7') {
            return true;
        }
        
        return $this->isHoliday($dateTime);
    }
}
