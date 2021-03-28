<?php

namespace App\Tests;

use App\StackOverflow\ApplicationService\DTO\QuestionGetterRequest;
use App\StackOverflow\ApplicationService\QuestionGetter;
use App\Tests\Spy\QuestionRepositorySpy;
use PHPUnit\Framework\TestCase;

class QuestionGetterTest extends TestCase
{
    /**
     * @test
     */
    public function shouldGetTheQuestionCollectionFromStackOverflowApi()
    {
        $questionRepositorySpy = new QuestionRepositorySpy();
        $service = new QuestionGetter(
            $questionRepositorySpy
        );

        $service(
            new QuestionGetterRequest(
                'symfony',
                '2021-03-01',
                '2021-03-10',
            )
        );

        $this->assertTrue($questionRepositorySpy->verify());
    }
}