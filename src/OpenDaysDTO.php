<?php

declare(strict_types=1);

namespace HolidayProvider;

class OpenDaysDTO
{
    /**
     * @throws HolidayProviderException
     */
    public function __construct(
        private bool $monday = true,
        private bool $tuesday = true,
        private bool $wednesday = true,
        private bool $thursday = true,
        private bool $friday = true,
        private bool $saturday = true,
        private bool $sunday = true,
    ) {
        if (
            $this->monday === false
            && $this->tuesday === false
            && $this->wednesday === false
            && $this->thursday === false
            && $this->friday === false
            && $this->saturday === false
            && $this->sunday === false
        ) {
            throw new HolidayProviderException('It must be at least one day set as open.');
        }
    }

    public function isOpen(\DateTimeInterface $dateTime): bool {
        return match ($dateTime->format('N')) {
            '1' => $this->monday,
            '2' => $this->tuesday,
            '3' => $this->wednesday,
            '4' => $this->thursday,
            '5' => $this->friday,
            '6' => $this->saturday,
            '7' => $this->sunday,
        };
    }
}
