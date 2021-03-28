<?php

declare(strict_types=1);

namespace App\StackOverflow\Domain;

interface QuestionRepository
{
    public function getQuestionCollection();
}