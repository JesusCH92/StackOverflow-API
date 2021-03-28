<?php

declare(strict_types=1);

namespace App\StackOverflow\Domain\ValueObject;

use App\StackOverflow\Domain\Exception\InvalidDate;
use App\StackOverflow\Domain\Exception\ToDateIsNotGreaterThanFromDate;
use DateTimeImmutable;

final class DateFilter
{
    public const FROM_DATE_FILTER = '&fromdate=';
    public const TO_DATE_FILTER = '&todate=';
    private string $fromDate;
    private string $toDate;

    public function __construct(string $fromDate, string $toDate)
    {
        $this->setRangeDate($fromDate, $toDate);
    }

    public function fromDate(): string
    {
        return $this->fromDate;
    }
    public function toDate(): string
    {
        return $this->toDate;
    }

    private function setRangeDate(string $fromDate, string $toDate): void
    {
        $this->guardIfRangeDateIsValid($fromDate, $toDate);
        $this->fromDate =  $fromDate;
        $this->toDate = $toDate;
    }

    private function guardIfRangeDateIsValid(string $fromDate, string $toDate): void
    {
        if ($this->isNotEmpty($fromDate) && $this->isValidDate($fromDate)) {
            throw new InvalidDate($fromDate);
        }

        if ($this->isNotEmpty($toDate) && $this->isValidDate($toDate)) {
            throw new InvalidDate($toDate);
        }

        if ($this->isNotEmpty($fromDate) &&
            $this->isNotEmpty($toDate) &&
            $this->isToDateGreaterThanFromDate($fromDate, $toDate)) {
            throw new ToDateIsNotGreaterThanFromDate($fromDate, $toDate);
        }
    }

    private function isNotEmpty(string $date): bool
    {
        return '' !== $date;
    }

    private function isValidDate(string $date): bool
    {
        $dateByYearAndMonthAndDay = explode('-', $date);

        $year = (int)($dateByYearAndMonthAndDay[0]);
        $month = (int)($dateByYearAndMonthAndDay[1]);
        $day = (int)($dateByYearAndMonthAndDay[2]);

        return (!checkdate($month, $day, $year) && 3 === count($dateByYearAndMonthAndDay));
    }

    private function isToDateGreaterThanFromDate(string $fromDate, string $toDate): bool
    {
        return new DateTimeImmutable($toDate) > new DateTimeImmutable($fromDate);
    }

    private function timeStampFormat(string $date): int
    {
        $date = new DateTimeImmutable($date);
        return $date->getTimestamp();
    }

    public function fromDateFilterFormat(): string
    {
        return '' === $this->fromDate ? '' : self::FROM_DATE_FILTER . $this->timeStampFormat($this->fromDate);
    }

    public function toDateFilterFormat(): string
    {
        return '' === $this->toDate  ? '' : self::FROM_DATE_FILTER . $this->timeStampFormat($this->toDate);
    }
}