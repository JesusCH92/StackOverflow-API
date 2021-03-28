<?php

declare(strict_types=1);

namespace App\StackOverflow\Infrastructure;

use App\StackOverflow\Domain\Filter;
use App\StackOverflow\Domain\QuestionRepository;

final class StackOverflowApiQuestionRepository implements QuestionRepository
{
    public function getQuestionCollection(Filter $filter)
    {

    }
}