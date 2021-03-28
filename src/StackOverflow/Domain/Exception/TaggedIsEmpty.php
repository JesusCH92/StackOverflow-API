<?php

declare(strict_types=1);

namespace App\StackOverflow\Domain\Exception;

use Exception;
use Throwable;

final class TaggedIsEmpty extends Exception
{
    public function __construct(string $value, $code = 0, Throwable $previous = null)
    {
        parent::__construct(sprintf('Tagged must not be empty', $value), $code, $previous);
    }
}