<?php


namespace App\Service\Common;


use DateTime;
use DateTimeImmutable;
use DateTimeZone;
use Exception;

class DateTimeService implements DateTimeServiceInterface
{
    /**
     * @return DateTime
     * @throws Exception
     */
    public function setDateTimeBlank(): DateTime
    {
        $dateFinish = new DateTime('0000-00-00 00:00:00');
        return $dateFinish;
    }

    /**
     *
     * @return string
     */
    public function setDateNow(): string
    {
        return date("dmY");
    }

    /**
     * @throws Exception
     */
    public function __toString(): string
    {
        return strval( $this->setDateTimeNow() ) ;
    }

    /**
     * @return DateTime
     * @throws Exception
     */
    public function setDateTimeNow(): DateTime
    {
        $timeZone = new DateTimeZone('Europe/Sofia');
        $datetime = new DateTime('now');
        $datetime->setTimezone($timeZone);
        return $datetime;
    }

    public function dateTimeToImmutableDateTime($date): DateTimeImmutable
    {
        return DateTimeImmutable::createFromMutable($date);
    }

    /**
     * @throws Exception
     */
    public function immutableDateTime(): DateTimeImmutable
    {
        return DateTimeImmutable::createFromMutable($this->setDateTimeNow());
    }
}
