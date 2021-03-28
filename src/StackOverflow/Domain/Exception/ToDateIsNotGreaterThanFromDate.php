<?php

declare(strict_types=1);

namespace App\StackOverflow\Domain\Exception;

use Exception;
use Throwable;

final class ToDateIsNotGreaterThanFromDate extends Exception
{
    public function __construct(string $fromDate, string $toDate, $code = 0, Throwable $previous = null)
    {
        parent::__construct(sprintf('"%s" (from date) must not be greater than "%s" (to date)', $fromDate, $toDate), $code, $previous);
    }
}