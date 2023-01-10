<?php

declare(strict_types=1);

namespace HolidayProvider;

use DateTime;
use DateTimeImmutable;
use DateTimeInterface;
use InvalidArgumentException;

class HolidayProvider
{
    public const COUNTRY_CZ = 'cz';
    public const COUNTRY_SK = 'sk';
    public const COUNTRY_RO = 'ro';
    public const COUNTRY_AT = 'at';
    public const COUNTRY_DE = 'de';
    public const COUNTRY_HU = 'hu';

    private const HOLIDAYS_CZ = [
        '2021 Day of renewal of the independent Czech state' => '2021-01-01',
        '2021 New Year\'s Day' => '2021-01-01',
        '2021 Good Friday' => '2021-04-02',
        '2021 Easter Monday' => '2021-04-05',
        '2021 International Workers\' Day' => '2021-05-01',
        '2021 Victory in Europe Day' => '2021-05-08',
        '2021 Saints Cyril and Methodius Day' => '2021-07-05',
        '2021 Jan Hus Day' => '2021-07-06',
        '2021 St. Wenceslas Day (Czech Statehood Day)' => '2021-09-28',
        '2021 Independent Czechoslovak State Day' => '2021-10-28',
        '2021 Struggle for Freedom and Democracy Day' => '2021-11-17',
        '2021 Christmas Eve' => '2021-12-24',
        '2021 Christmas' => '2021-12-25',
        '2021 Second Christmas Day' => '2021-12-26',
        '2022 Day of renewal of the independent Czech state' => '2022-01-01',
        '2022 New Year\'s Day' => '2022-01-01',
        '2022 Good Friday' => '2022-04-15',
        '2022 Easter Monday' => '2022-04-18',
        '2022 International Workers\' Day' => '2022-05-01',
        '2022 Victory in Europe Day' => '2022-05-08',
        '2022 Saints Cyril and Methodius Day' => '2022-07-05',
        '2022 Jan Hus Day' => '2022-07-06',
        '2022 St. Wenceslas Day (Czech Statehood Day)' => '2022-09-28',
        '2022 Independent Czechoslovak State Day' => '2022-10-28',
        '2022 Struggle for Freedom and Democracy Day' => '2022-11-17',
        '2022 Christmas Eve' => '2022-12-24',
        '2022 Christmas' => '2022-12-25',
        '2022 Second Christmas Day' => '2022-12-26',
        '2023 Day of renewal of the independent Czech state' => '2023-01-01',
        '2023 New Year\'s Day' => '2023-01-01',
        '2023 Good Friday' => '2023-04-07',
        '2023 Easter Monday' => '2023-04-10',
        '2023 International Workers\' Day' => '2023-05-01',
        '2023 Victory in Europe Day' => '2023-05-08',
        '2023 Saints Cyril and Methodius Day' => '2023-07-05',
        '2023 Jan Hus Day' => '2023-07-06',
        '2023 St. Wenceslas Day (Czech Statehood Day)' => '2023-09-28',
        '2023 Independent Czechoslovak State Day' => '2023-10-28',
        '2023 Struggle for Freedom and Democracy Day' => '2023-11-17',
        '2023 Christmas Eve' => '2023-12-24',
        '2023 Christmas' => '2023-12-25',
        '2023 Second Christmas Day' => '2023-12-26',
        '2024 Day of renewal of the independent Czech state' => '2024-01-01',
        '2024 New Year\'s Day' => '2024-01-01',
        '2024 Good Friday' => '2024-03-29',
        '2024 Easter Monday' => '2024-04-01',
        '2024 International Workers\' Day' => '2024-05-01',
        '2024 Victory in Europe Day' => '2024-05-08',
        '2024 Saints Cyril and Methodius Day' => '2024-07-05',
        '2024 Jan Hus Day' => '2024-07-06',
        '2024 St. Wenceslas Day (Czech Statehood Day)' => '2024-09-28',
        '2024 Independent Czechoslovak State Day' => '2024-10-28',
        '2024 Struggle for Freedom and Democracy Day' => '2024-11-17',
        '2024 Christmas Eve' => '2024-12-24',
        '2024 Christmas' => '2024-12-25',
        '2024 Second Christmas Day' => '2024-12-26',
        '2025 Day of renewal of the independent Czech state' => '2025-01-01',
        '2025 New Year\'s Day' => '2025-01-01',
        '2025 Good Friday' => '2025-04-18',
        '2025 Easter Monday' => '2025-04-21',
        '2025 International Workers\' Day' => '2025-05-01',
        '2025 Victory in Europe Day' => '2025-05-08',
        '2025 Saints Cyril and Methodius Day' => '2025-07-05',
        '2025 Jan Hus Day' => '2025-07-06',
        '2025 St. Wenceslas Day (Czech Statehood Day)' => '2025-09-28',
        '2025 Independent Czechoslovak State Day' => '2025-10-28',
        '2025 Struggle for Freedom and Democracy Day' => '2025-11-17',
        '2025 Christmas Eve' => '2025-12-24',
        '2025 Christmas' => '2025-12-25',
        '2025 Second Christmas Day' => '2025-12-26',
        '2026 Day of renewal of the independent Czech state' => '2026-01-01',
        '2026 New Year\'s Day' => '2026-01-01',
        '2026 Good Friday' => '2026-04-03',
        '2026 Easter Monday' => '2026-04-06',
        '2026 International Workers\' Day' => '2026-05-01',
        '2026 Victory in Europe Day' => '2026-05-08',
        '2026 Saints Cyril and Methodius Day' => '2026-07-05',
        '2026 Jan Hus Day' => '2026-07-06',
        '2026 St. Wenceslas Day (Czech Statehood Day)' => '2026-09-28',
        '2026 Independent Czechoslovak State Day' => '2026-10-28',
        '2026 Struggle for Freedom and Democracy Day' => '2026-11-17',
        '2026 Christmas Eve' => '2026-12-24',
        '2026 Christmas' => '2026-12-25',
        '2026 Second Christmas Day' => '2026-12-26',
        '2027 Day of renewal of the independent Czech state' => '2027-01-01',
        '2027 New Year\'s Day' => '2027-01-01',
        '2027 Good Friday' => '2027-03-26',
        '2027 Easter Monday' => '2027-03-29',
        '2027 International Workers\' Day' => '2027-05-01',
        '2027 Victory in Europe Day' => '2027-05-08',
        '2027 Saints Cyril and Methodius Day' => '2027-07-05',
        '2027 Jan Hus Day' => '2027-07-06',
        '2027 St. Wenceslas Day (Czech Statehood Day)' => '2027-09-28',
        '2027 Independent Czechoslovak State Day' => '2027-10-28',
        '2027 Struggle for Freedom and Democracy Day' => '2027-11-17',
        '2027 Christmas Eve' => '2027-12-24',
        '2027 Christmas' => '2027-12-25',
        '2027 Second Christmas Day' => '2027-12-26',
        '2028 Day of renewal of the independent Czech state' => '2028-01-01',
        '2028 New Year\'s Day' => '2028-01-01',
        '2028 Good Friday' => '2028-04-14',
        '2028 Easter Monday' => '2028-04-17',
        '2028 International Workers\' Day' => '2028-05-01',
        '2028 Victory in Europe Day' => '2028-05-08',
        '2028 Saints Cyril and Methodius Day' => '2028-07-05',
        '2028 Jan Hus Day' => '2028-07-06',
        '2028 St. Wenceslas Day (Czech Statehood Day)' => '2028-09-28',
        '2028 Independent Czechoslovak State Day' => '2028-10-28',
        '2028 Struggle for Freedom and Democracy Day' => '2028-11-17',
        '2028 Christmas Eve' => '2028-12-24',
        '2028 Christmas' => '2028-12-25',
        '2028 Second Christmas Day' => '2028-12-26',
        '2029 Day of renewal of the independent Czech state' => '2029-01-01',
        '2029 New Year\'s Day' => '2029-01-01',
        '2029 Good Friday' => '2029-03-30',
        '2029 Easter Monday' => '2029-04-02',
        '2029 International Workers\' Day' => '2029-05-01',
        '2029 Victory in Europe Day' => '2029-05-08',
        '2029 Saints Cyril and Methodius Day' => '2029-07-05',
        '2029 Jan Hus Day' => '2029-07-06',
        '2029 St. Wenceslas Day (Czech Statehood Day)' => '2029-09-28',
        '2029 Independent Czechoslovak State Day' => '2029-10-28',
        '2029 Struggle for Freedom and Democracy Day' => '2029-11-17',
        '2029 Christmas Eve' => '2029-12-24',
        '2029 Christmas' => '2029-12-25',
        '2029 Second Christmas Day' => '2029-12-26',
        '2030 Day of renewal of the independent Czech state' => '2030-01-01',
        '2030 New Year\'s Day' => '2030-01-01',
        '2030 Good Friday' => '2030-04-19',
        '2030 Easter Monday' => '2030-04-22',
        '2030 International Workers\' Day' => '2030-05-01',
        '2030 Victory in Europe Day' => '2030-05-08',
        '2030 Saints Cyril and Methodius Day' => '2030-07-05',
        '2030 Jan Hus Day' => '2030-07-06',
        '2030 St. Wenceslas Day (Czech Statehood Day)' => '2030-09-28',
        '2030 Independent Czechoslovak State Day' => '2030-10-28',
        '2030 Struggle for Freedom and Democracy Day' => '2030-11-17',
        '2030 Christmas Eve' => '2030-12-24',
        '2030 Christmas' => '2030-12-25',
        '2030 Second Christmas Day' => '2030-12-26',
    ];

    public const HOLIDAYS_SK = [
        '2021 Day of the Establishment of the Slovak Republic' => '2021-01-01',
        '2021 Epiphany' => '2021-01-06',
        '2021 Good Friday' => '2021-04-02',
        '2021 Easter Monday' => '2021-04-05',
        '2021 International Workers\' Day' => '2021-05-01',
        '2021 Victory in Europe Day' => '2021-05-08',
        '2021 Saints Cyril and Methodius Day' => '2021-07-05',
        '2021 Slovak National Uprising Day' => '2021-08-29',
        '2021 Day of the Constitution of the Slovak Republic' => '2021-09-01',
        '2021 Our Lady of Sorrows Day' => '2021-09-15',
        '2021 All Saints\' Day' => '2021-11-01',
        '2021 Struggle for Freedom and Democracy Day' => '2021-11-17',
        '2021 Christmas Eve' => '2021-12-24',
        '2021 Christmas' => '2021-12-25',
        '2021 Second Christmas Day' => '2021-12-26',
        '2021 Moving holiday' => '2021-12-31',
        '2022 Day of the Establishment of the Slovak Republic' => '2022-01-01',
        '2022 Epiphany' => '2022-01-06',
        '2022 Good Friday' => '2022-04-15',
        '2022 Easter Monday' => '2022-04-18',
        '2022 International Workers\' Day' => '2022-05-01',
        '2022 Victory in Europe Day' => '2022-05-08',
        '2022 Saints Cyril and Methodius Day' => '2022-07-05',
        '2022 Slovak National Uprising Day' => '2022-08-29',
        '2022 Day of the Constitution of the Slovak Republic' => '2022-09-01',
        '2022 Our Lady of Sorrows Day' => '2022-09-15',
        '2022 Stock taking' => '2022-10-07',
        '2022 All Saints\' Day' => '2022-11-01',
        '2022 Struggle for Freedom and Democracy Day' => '2022-11-17',
        '2022 Christmas Eve' => '2022-12-24',
        '2022 Christmas' => '2022-12-25',
        '2022 Second Christmas Day' => '2022-12-26',
        '2023 Day of the Establishment of the Slovak Republic' => '2023-01-01',
        '2023 Epiphany' => '2023-01-06',
        '2023 Good Friday' => '2023-04-07',
        '2023 Easter Monday' => '2023-04-10',
        '2023 International Workers\' Day' => '2023-05-01',
        '2023 Victory in Europe Day' => '2023-05-08',
        '2023 Saints Cyril and Methodius Day' => '2023-07-05',
        '2023 Slovak National Uprising Day' => '2023-08-29',
        '2023 Day of the Constitution of the Slovak Republic' => '2023-09-01',
        '2023 Our Lady of Sorrows Day' => '2023-09-15',
        '2023 All Saints\' Day' => '2023-11-01',
        '2023 Struggle for Freedom and Democracy Day' => '2023-11-17',
        '2023 Christmas Eve' => '2023-12-24',
        '2023 Christmas' => '2023-12-25',
        '2023 Second Christmas Day' => '2023-12-26',
        '2024 Day of the Establishment of the Slovak Republic' => '2024-01-01',
        '2024 Epiphany' => '2024-01-06',
        '2024 Good Friday' => '2024-03-29',
        '2024 Easter Monday' => '2024-04-01',
        '2024 International Workers\' Day' => '2024-05-01',
        '2024 Victory in Europe Day' => '2024-05-08',
        '2024 Saints Cyril and Methodius Day' => '2024-07-05',
        '2024 Slovak National Uprising Day' => '2024-08-29',
        '2024 Day of the Constitution of the Slovak Republic' => '2024-09-01',
        '2024 Our Lady of Sorrows Day' => '2024-09-15',
        '2024 All Saints\' Day' => '2024-11-01',
        '2024 Struggle for Freedom and Democracy Day' => '2024-11-17',
        '2024 Christmas Eve' => '2024-12-24',
        '2024 Christmas' => '2024-12-25',
        '2024 Second Christmas Day' => '2024-12-26',
        '2025 Day of the Establishment of the Slovak Republic' => '2025-01-01',
        '2025 Epiphany' => '2025-01-06',
        '2025 Good Friday' => '2025-04-18',
        '2025 Easter Monday' => '2025-04-21',
        '2025 International Workers\' Day' => '2025-05-01',
        '2025 Victory in Europe Day' => '2025-05-08',
        '2025 Saints Cyril and Methodius Day' => '2025-07-05',
        '2025 Slovak National Uprising Day' => '2025-08-29',
        '2025 Day of the Constitution of the Slovak Republic' => '2025-09-01',
        '2025 Our Lady of Sorrows Day' => '2025-09-15',
        '2025 All Saints\' Day' => '2025-11-01',
        '2025 Struggle for Freedom and Democracy Day' => '2025-11-17',
        '2025 Christmas Eve' => '2025-12-24',
        '2025 Christmas' => '2025-12-25',
        '2025 Second Christmas Day' => '2025-12-26',
        '2026 Day of the Establishment of the Slovak Republic' => '2026-01-01',
        '2026 Epiphany' => '2026-01-06',
        '2026 Good Friday' => '2026-04-03',
        '2026 Easter Monday' => '2026-04-06',
        '2026 International Workers\' Day' => '2026-05-01',
        '2026 Victory in Europe Day' => '2026-05-08',
        '2026 Saints Cyril and Methodius Day' => '2026-07-05',
        '2026 Slovak National Uprising Day' => '2026-08-29',
        '2026 Day of the Constitution of the Slovak Republic' => '2026-09-01',
        '2026 Our Lady of Sorrows Day' => '2026-09-15',
        '2026 All Saints\' Day' => '2026-11-01',
        '2026 Struggle for Freedom and Democracy Day' => '2026-11-17',
        '2026 Christmas Eve' => '2026-12-24',
        '2026 Christmas' => '2026-12-25',
        '2026 Second Christmas Day' => '2026-12-26',
        '2027 Day of the Establishment of the Slovak Republic' => '2027-01-01',
        '2027 Epiphany' => '2027-01-06',
        '2027 Good Friday' => '2027-03-26',
        '2027 Easter Monday' => '2027-03-29',
        '2027 International Workers\' Day' => '2027-05-01',
        '2027 Victory in Europe Day' => '2027-05-08',
        '2027 Saints Cyril and Methodius Day' => '2027-07-05',
        '2027 Slovak National Uprising Day' => '2027-08-29',
        '2027 Day of the Constitution of the Slovak Republic' => '2027-09-01',
        '2027 Our Lady of Sorrows Day' => '2027-09-15',
        '2027 All Saints\' Day' => '2027-11-01',
        '2027 Struggle for Freedom and Democracy Day' => '2027-11-17',
        '2027 Christmas Eve' => '2027-12-24',
        '2027 Christmas' => '2027-12-25',
        '2027 Second Christmas Day' => '2027-12-26',
        '2028 Day of the Establishment of the Slovak Republic' => '2028-01-01',
        '2028 Epiphany' => '2028-01-06',
        '2028 Good Friday' => '2028-04-14',
        '2028 Easter Monday' => '2028-04-17',
        '2028 International Workers\' Day' => '2028-05-01',
        '2028 Victory in Europe Day' => '2028-05-08',
        '2028 Saints Cyril and Methodius Day' => '2028-07-05',
        '2028 Slovak National Uprising Day' => '2028-08-29',
        '2028 Day of the Constitution of the Slovak Republic' => '2028-09-01',
        '2028 Our Lady of Sorrows Day' => '2028-09-15',
        '2028 All Saints\' Day' => '2028-11-01',
        '2028 Struggle for Freedom and Democracy Day' => '2028-11-17',
        '2028 Christmas Eve' => '2028-12-24',
        '2028 Christmas' => '2028-12-25',
        '2028 Second Christmas Day' => '2028-12-26',
        '2029 Day of the Establishment of the Slovak Republic' => '2029-01-01',
        '2029 Epiphany' => '2029-01-06',
        '2029 Good Friday' => '2029-03-30',
        '2029 Easter Monday' => '2029-04-02',
        '2029 International Workers\' Day' => '2029-05-01',
        '2029 Victory in Europe Day' => '2029-05-08',
        '2029 Saints Cyril and Methodius Day' => '2029-07-05',
        '2029 Slovak National Uprising Day' => '2029-08-29',
        '2029 Day of the Constitution of the Slovak Republic' => '2029-09-01',
        '2029 Our Lady of Sorrows Day' => '2029-09-15',
        '2029 All Saints\' Day' => '2029-11-01',
        '2029 Struggle for Freedom and Democracy Day' => '2029-11-17',
        '2029 Christmas Eve' => '2029-12-24',
        '2029 Christmas' => '2029-12-25',
        '2029 Second Christmas Day' => '2029-12-26',
        '2030 Day of the Establishment of the Slovak Republic' => '2030-01-01',
        '2030 Epiphany' => '2030-01-06',
        '2030 Good Friday' => '2030-04-19',
        '2030 Easter Monday' => '2030-04-22',
        '2030 International Workers\' Day' => '2030-05-01',
        '2030 Victory in Europe Day' => '2030-05-08',
        '2030 Saints Cyril and Methodius Day' => '2030-07-05',
        '2030 Slovak National Uprising Day' => '2030-08-29',
        '2030 Day of the Constitution of the Slovak Republic' => '2030-09-01',
        '2030 Our Lady of Sorrows Day' => '2030-09-15',
        '2030 All Saints\' Day' => '2030-11-01',
        '2030 Struggle for Freedom and Democracy Day' => '2030-11-17',
        '2030 Christmas Eve' => '2030-12-24',
        '2030 Christmas' => '2030-12-25',
        '2030 Second Christmas Day' => '2030-12-26',
    ];

    public const HOLIDAYS_RO = [
        '2021 New Year\'s Day' => '2021-01-01',
        '2021 Day after New Year\'s Day' => '2021-01-02',
        '2021 Union Day / Small Union' => '2021-01-24',
        '2021 Constantin Brâncuși day' => '2021-02-19',
        '2021 International Workers\' Day' => '2021-05-01',
        '2021 Easter Sunday' => '2021-05-02',
        '2021 Easter Monday' => '2021-05-03',
        '2021 International Children\'s Day' => '2021-06-01',
        '2021 Whitsunday' => '2021-06-20',
        '2021 Whitmonday' => '2021-06-21',
        '2021 Assumption of Mary' => '2021-08-15',
        '2021 St. Andrew\'s Day' => '2021-11-30',
        '2021 National Day' => '2021-12-01',
        '2021 Christmas' => '2021-12-25',
        '2021 Second Christmas Day' => '2021-12-26',
        '2022 New Year\'s Day' => '2022-01-01',
        '2022 Day after New Year\'s Day' => '2022-01-02',
        '2022 Union Day / Small Union' => '2022-01-24',
        '2022 Constantin Brâncuși day' => '2022-02-19',
        '2022 Easter Sunday' => '2022-04-24',
        '2022 Easter Monday' => '2022-04-25',
        '2022 International Workers\' Day' => '2022-05-01',
        '2022 International Children\'s Day' => '2022-06-01',
        '2022 Whitsunday' => '2022-06-12',
        '2022 Whitmonday' => '2022-06-13',
        '2022 Assumption of Mary' => '2022-08-15',
        '2022 St. Andrew\'s Day' => '2022-11-30',
        '2022 National Day' => '2022-12-01',
        '2022 Christmas' => '2022-12-25',
        '2022 Second Christmas Day' => '2022-12-26',
        '2023 New Year\'s Day' => '2023-01-01',
        '2023 Day after New Year\'s Day' => '2023-01-02',
        '2023 Union Day / Small Union' => '2023-01-24',
        '2023 Constantin Brâncuși day' => '2023-02-19',
        '2023 Easter Sunday' => '2023-04-16',
        '2023 Easter Monday' => '2023-04-17',
        '2023 International Workers\' Day' => '2023-05-01',
        '2023 International Children\'s Day' => '2023-06-01',
        '2023 Whitsunday' => '2023-06-04',
        '2023 Whitmonday' => '2023-06-05',
        '2023 Assumption of Mary' => '2023-08-15',
        '2023 St. Andrew\'s Day' => '2023-11-30',
        '2023 National Day' => '2023-12-01',
        '2023 Christmas' => '2023-12-25',
        '2023 Second Christmas Day' => '2023-12-26',
        '2024 New Year\'s Day' => '2024-01-01',
        '2024 Day after New Year\'s Day' => '2024-01-02',
        '2024 Union Day / Small Union' => '2024-01-24',
        '2024 Constantin Brâncuși day' => '2024-02-19',
        '2024 International Workers\' Day' => '2024-05-01',
        '2024 Easter Sunday' => '2024-05-05',
        '2024 Easter Monday' => '2024-05-06',
        '2024 International Children\'s Day' => '2024-06-01',
        '2024 Whitsunday' => '2024-06-23',
        '2024 Whitmonday' => '2024-06-24',
        '2024 Assumption of Mary' => '2024-08-15',
        '2024 St. Andrew\'s Day' => '2024-11-30',
        '2024 National Day' => '2024-12-01',
        '2024 Christmas' => '2024-12-25',
        '2024 Second Christmas Day' => '2024-12-26',
        '2025 New Year\'s Day' => '2025-01-01',
        '2025 Day after New Year\'s Day' => '2025-01-02',
        '2025 Union Day / Small Union' => '2025-01-24',
        '2025 Constantin Brâncuși day' => '2025-02-19',
        '2025 Easter Sunday' => '2025-04-20',
        '2025 Easter Monday' => '2025-04-21',
        '2025 International Workers\' Day' => '2025-05-01',
        '2025 International Children\'s Day' => '2025-06-01',
        '2025 Whitsunday' => '2025-06-08',
        '2025 Whitmonday' => '2025-06-09',
        '2025 Assumption of Mary' => '2025-08-15',
        '2025 St. Andrew\'s Day' => '2025-11-30',
        '2025 National Day' => '2025-12-01',
        '2025 Christmas' => '2025-12-25',
        '2025 Second Christmas Day' => '2025-12-26',
        '2026 New Year\'s Day' => '2026-01-01',
        '2026 Day after New Year\'s Day' => '2026-01-02',
        '2026 Union Day / Small Union' => '2026-01-24',
        '2026 Constantin Brâncuși day' => '2026-02-19',
        '2026 Easter Sunday' => '2026-04-12',
        '2026 Easter Monday' => '2026-04-13',
        '2026 International Workers\' Day' => '2026-05-01',
        '2026 Whitsunday' => '2026-05-31',
        '2026 International Children\'s Day' => '2026-06-01',
        '2026 Whitmonday' => '2026-06-01',
        '2026 Assumption of Mary' => '2026-08-15',
        '2026 St. Andrew\'s Day' => '2026-11-30',
        '2026 National Day' => '2026-12-01',
        '2026 Christmas' => '2026-12-25',
        '2026 Second Christmas Day' => '2026-12-26',
        '2027 New Year\'s Day' => '2027-01-01',
        '2027 Day after New Year\'s Day' => '2027-01-02',
        '2027 Union Day / Small Union' => '2027-01-24',
        '2027 Constantin Brâncuși day' => '2027-02-19',
        '2027 International Workers\' Day' => '2027-05-01',
        '2027 Easter Sunday' => '2027-05-02',
        '2027 Easter Monday' => '2027-05-03',
        '2027 International Children\'s Day' => '2027-06-01',
        '2027 Whitsunday' => '2027-06-20',
        '2027 Whitmonday' => '2027-06-21',
        '2027 Assumption of Mary' => '2027-08-15',
        '2027 St. Andrew\'s Day' => '2027-11-30',
        '2027 National Day' => '2027-12-01',
        '2027 Christmas' => '2027-12-25',
        '2027 Second Christmas Day' => '2027-12-26',
        '2028 New Year\'s Day' => '2028-01-01',
        '2028 Day after New Year\'s Day' => '2028-01-02',
        '2028 Union Day / Small Union' => '2028-01-24',
        '2028 Constantin Brâncuși day' => '2028-02-19',
        '2028 Easter Sunday' => '2028-04-16',
        '2028 Easter Monday' => '2028-04-17',
        '2028 International Workers\' Day' => '2028-05-01',
        '2028 International Children\'s Day' => '2028-06-01',
        '2028 Whitsunday' => '2028-06-04',
        '2028 Whitmonday' => '2028-06-05',
        '2028 Assumption of Mary' => '2028-08-15',
        '2028 St. Andrew\'s Day' => '2028-11-30',
        '2028 National Day' => '2028-12-01',
        '2028 Christmas' => '2028-12-25',
        '2028 Second Christmas Day' => '2028-12-26',
        '2029 New Year\'s Day' => '2029-01-01',
        '2029 Day after New Year\'s Day' => '2029-01-02',
        '2029 Union Day / Small Union' => '2029-01-24',
        '2029 Constantin Brâncuși day' => '2029-02-19',
        '2029 Easter Sunday' => '2029-04-08',
        '2029 Easter Monday' => '2029-04-09',
        '2029 International Workers\' Day' => '2029-05-01',
        '2029 Whitsunday' => '2029-05-27',
        '2029 Whitmonday' => '2029-05-28',
        '2029 International Children\'s Day' => '2029-06-01',
        '2029 Assumption of Mary' => '2029-08-15',
        '2029 St. Andrew\'s Day' => '2029-11-30',
        '2029 National Day' => '2029-12-01',
        '2029 Christmas' => '2029-12-25',
        '2029 Second Christmas Day' => '2029-12-26',
        '2030 New Year\'s Day' => '2030-01-01',
        '2030 Day after New Year\'s Day' => '2030-01-02',
        '2030 Union Day / Small Union' => '2030-01-24',
        '2030 Constantin Brâncuși day' => '2030-02-19',
        '2030 Easter Sunday' => '2030-04-28',
        '2030 Easter Monday' => '2030-04-29',
        '2030 International Workers\' Day' => '2030-05-01',
        '2030 International Children\'s Day' => '2030-06-01',
        '2030 Whitsunday' => '2030-06-16',
        '2030 Whitmonday' => '2030-06-17',
        '2030 Assumption of Mary' => '2030-08-15',
        '2030 St. Andrew\'s Day' => '2030-11-30',
        '2030 National Day' => '2030-12-01',
        '2030 Christmas' => '2030-12-25',
        '2030 Second Christmas Day' => '2030-12-26',
    ];

    /** @var array<string, string> */
    private array $holidays;

    /**
     * @param string $country
     * @throws HolidayProviderException
     */
    public function __construct(string $country)
    {
        switch ($country) {
            case self::COUNTRY_CZ:
            case 'CZ':
            case 'cs':
            case 'CS':
            case 'Czechia':
            case 'CzechRepublic':
                $this->holidays = self::HOLIDAYS_CZ;
                break;
            case self::COUNTRY_SK:
            case 'SK':
            case 'Slovakia':
            case 'SlovakRepublic':
                $this->holidays = self::HOLIDAYS_SK;
                break;
            case self::COUNTRY_DE:
            case self::COUNTRY_HU:
            case self::COUNTRY_AT:
                $this->holidays = []; // TODO add holidays for HU and AT
                break;
            case self::COUNTRY_RO:
            case 'RO':
            case 'Romania':
                $this->holidays = self::HOLIDAYS_RO;
                break;
            default:
                throw new HolidayProviderException('country '.$country.' is not supported');
        }
    }

    public function isHoliday(DateTimeInterface $dateTime): bool
    {
        return in_array($dateTime->format('Y-m-d'), $this->holidays, true);
    }

    public function isWeekendOrHoliday(DateTimeInterface $dateTime): bool
    {
        $dayOfTheWeek = $dateTime->format('N');
        if ($dayOfTheWeek === '6' || $dayOfTheWeek === '7') {
            return true;
        }

        return $this->isHoliday($dateTime);
    }

    /**
     * @return string[] in DateTimeInterface->format('Y-m-d')
     */
    public function findAllHolidays(): array
    {
        return $this->holidays;
    }

    /**
     * @throws HolidayProviderException
     */
    public function getDateIncrementedByHolidaysAndWeekends(
        DateTimeInterface $dateTime,
        int $incrementByDays
    ): DateTimeImmutable {
        $this->checkIfInBounds($incrementByDays);

        $daysWithoutHolidaysAndWeekends = 0;
        $nonImmutable = new DateTime($dateTime->format('Y-m-d H:i:s'));

        do {
            $nonImmutable->modify('+1 day');

            if ($this->isWeekendOrHoliday($nonImmutable) === false) {
                $daysWithoutHolidaysAndWeekends++;
            }

        } while ($daysWithoutHolidaysAndWeekends < $incrementByDays);

        return new DateTimeImmutable($nonImmutable->format('Y-m-d H:i:s'));
    }

    /**
     * @throws HolidayProviderException
     */
    public function getDateIncrementedByHolidaysAndOpenDays(
        DateTimeInterface $dateTime,
        int $incrementByDays,
        OpenDaysDTO $openDays
    ): DateTimeImmutable {
        $this->checkIfInBounds($incrementByDays);

        $daysWithoutHolidaysAndClosedDays = 0;
        $nonImmutable = new DateTime($dateTime->format('Y-m-d H:i:s'));

        do {
            $nonImmutable->modify('+1 day');

            if (!$this->isHoliday($nonImmutable) && $openDays->isOpen($nonImmutable)) {
                $daysWithoutHolidaysAndClosedDays++;
            }

        } while ($daysWithoutHolidaysAndClosedDays < $incrementByDays);

        return new DateTimeImmutable($nonImmutable->format('Y-m-d H:i:s'));
    }

    /**
     * @throws HolidayProviderException
     */
    private function checkIfInBounds(int $incrementByDays): void
    {
        if ($incrementByDays < 1 || $incrementByDays > 99999) {
            throw new HolidayProviderException('Increment days must be higher than 0');
        }
    }
}
