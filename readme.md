## Install

```shell
composer require pilulka-distribuce/holiday-provider
```

## Usage

```php
$provider = new HolidayProvider(HolidayProvider::COUNTRY_CZ);
$isHolidayOrWeekendBoolean = $provider->isWeekendOrHoliday(new DateTime());
```

## Tests

### PHP 7.1

```bash
docker-compose up -d 
docker exec -it holiday-provider_app71_1 vendor/bin/phpunit tests
docker exec -it holiday-provider_app80_1 vendor/bin/phpunit tests
```
