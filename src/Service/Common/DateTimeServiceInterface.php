<?php


namespace App\Service\Common;


use DateTime;
use DateTimeImmutable;

interface DateTimeServiceInterface
{
    public function setDateTimeNow(): DateTime;

    public function setDateTimeBlank(): DateTime;

    public function dateTimeToImmutableDateTime($date): DateTimeImmutable;
}
