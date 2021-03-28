<?php

namespace App\Tests;

use App\StackOverflow\ApplicationService\DTO\QuestionGetterRequest;
use App\StackOverflow\ApplicationService\QuestionGetter;
use App\StackOverflow\Domain\Exception\TaggedIsEmpty;
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

    /**
     * @test
     */
    public function shouldThrowExceptionWhenTaggedFilterIsEmpty()
    {
        $this->expectException(TaggedIsEmpty::class);

        $questionRepositorySpy = new QuestionRepositorySpy();
        $service = new QuestionGetter(
            $questionRepositorySpy
        );

        $service(
            new QuestionGetterRequest(
                '',
                '2021-03-01',
                '2021-03-10',
            )
        );
    }
}