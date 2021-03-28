<?php

declare(strict_types=1);

namespace App\StackOverflow\ApplicationService\DTO;

final class QuestionGetterResponse
{
    private array $questionCollection;

    public function __construct(array $questionCollection)
    {
        $this->questionCollection = $questionCollection;
    }

    public function questionCollection(): array
    {
        return $this->questionCollection;
    }
}