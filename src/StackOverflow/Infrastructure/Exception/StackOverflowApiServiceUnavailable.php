<?php

declare(strict_types=1);

namespace App\StackOverflow\Infrastructure\Exception;

use Exception;
use Throwable;

final class StackOverflowApiServiceUnavailable extends Exception
{
    public function __construct($code = 0, Throwable $previous = null)
    {
        parent::__construct(sprintf('StackOverflow API service is unavailable at this moment'), $code, $previous);
    }
}