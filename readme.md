## Install

```shell
composer require  PilulkaDistribuce/holiday-provider
```

## Usage

```php
$provider = new HolidayProvider(HolidayProvider::COUNTRY_CZ);
$isHolidayOrWeekendBoolean = $provider->isWeekendOrHoliday(new DateTime());
```
