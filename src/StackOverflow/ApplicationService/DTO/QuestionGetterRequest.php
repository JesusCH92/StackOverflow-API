<?php

declare(strict_types=1);

namespace App\StackOverflow\ApplicationService\DTO;

final class QuestionGetterRequest
{
    private string $tagged;
    private string $toDate;
    private string $fromDate;

    public function __construct(string $tagged, string $fromDate, string $toDate)
    {
        $this->tagged = $tagged;
        $this->fromDate = $fromDate;
        $this->toDate = $toDate;
    }

    public function tagged(): string
    {
        return $this->tagged;
    }

    public function fromDate(): string
    {
        return $this->fromDate;
    }

    public function toDate(): string
    {
        return $this->toDate;
    }
}