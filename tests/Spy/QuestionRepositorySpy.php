<?php

namespace App\Tests\Spy;

use App\StackOverflow\Domain\Filter;
use App\StackOverflow\Domain\QuestionRepository;

class QuestionRepositorySpy implements QuestionRepository
{
    private $validateWasCalled = false;

    public function getQuestionCollection(Filter $filter)
    {
        $this->validateWasCalled = true;

        return [];
    }

    public function verify(): bool
    {
        return $this->validateWasCalled;
    }
}