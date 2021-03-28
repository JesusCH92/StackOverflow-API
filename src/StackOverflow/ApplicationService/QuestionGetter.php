<?php

declare(strict_types=1);

namespace App\StackOverflow\ApplicationService;

use App\StackOverflow\ApplicationService\DTO\QuestionGetterRequest;

final class QuestionGetter
{
    public function __invoke(QuestionGetterRequest $questionGetterRequest)
    {
        return 'question collection';
    }
}