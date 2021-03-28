<?php

declare(strict_types=1);

namespace App\StackOverflow\Domain\Exception;

use Exception;
use Throwable;

final class InvalidDate extends Exception
{
    public function __construct(string $value, $code = 0, Throwable $previous = null)
    {
        parent::__construct(sprintf('"%s" date is invalid, YYYY-mm-dd format', $value), $code, $previous);
    }
}