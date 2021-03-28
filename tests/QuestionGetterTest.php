<?php

namespace App\Tests;

use App\StackOverflow\ApplicationService\DTO\QuestionGetterRequest;
use App\StackOverflow\ApplicationService\QuestionGetter;
use App\StackOverflow\Domain\Exception\TaggedIsEmpty;
use App\StackOverflow\Domain\Exception\ToDateIsNotGreaterThanFromDate;
use App\StackOverflow\Infrastructure\StackOverflowApiQuestionRepository;
use App\Tests\Spy\QuestionRepositorySpy;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpClient\HttpClient;

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

        $service = new QuestionGetter(
            new StackOverflowApiQuestionRepository(
                HttpClient::create()
            )
        );

        $service(
            new QuestionGetterRequest(
                '',
                '2021-03-01',
                '2021-03-10',
            )
        );
    }

    /**
     * @test
     */
    public function shouldThrowExceptionWhenToDateFilterIsNotGreaterThanFromDateFilter()
    {
        $this->expectException(ToDateIsNotGreaterThanFromDate::class);

        $service = new QuestionGetter(
            new StackOverflowApiQuestionRepository(
                HttpClient::create()
            )
        );

        $service(
            new QuestionGetterRequest(
                'symfony',
                '2021-03-10',
                '2021-03-01',
            )
        );
    }
}