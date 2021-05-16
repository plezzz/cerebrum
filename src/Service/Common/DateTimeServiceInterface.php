<?php


namespace App\Service\Common;


use DateTime;

interface DateTimeServiceInterface
{
    public function setDateTimeNow(): DateTime;
    public function setDateTimeBlank():DateTime;
}
