<?php

declare(strict_types=1);

namespace App\StackOverflow\ApplicationService;

use App\StackOverflow\ApplicationService\DTO\QuestionGetterRequest;
use App\StackOverflow\Domain\Filter;
use App\StackOverflow\Domain\QuestionRepository;
use App\StackOverflow\Domain\ValueObject\DateFilter;
use App\StackOverflow\Domain\ValueObject\TaggedFilter;

final class QuestionGetter
{
    private QuestionRepository $questionRepository;

    public function __construct(QuestionRepository $questionRepository)
    {
        $this->questionRepository = $questionRepository;
    }

    public function __invoke(QuestionGetterRequest $questionGetterRequest)
    {
        $questionCollection = $this->questionRepository->getQuestionCollection(
            new Filter(
                new TaggedFilter($questionGetterRequest->tagged()),
                new DateFilter(
                    $questionGetterRequest->toDate(),
                    $questionGetterRequest->fromDate()
                )
            )
        );
        return $questionCollection;
    }
}