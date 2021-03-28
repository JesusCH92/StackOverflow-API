<?php

declare(strict_types=1);

namespace App\StackOverflow\Infrastructure;

use App\StackOverflow\Domain\Filter;
use App\StackOverflow\Domain\QuestionRepository;
use App\StackOverflow\Infrastructure\Exception\StackOverflowApiServiceUnavailable;
use Symfony\Contracts\HttpClient\HttpClientInterface;

final class StackOverflowApiQuestionRepository implements QuestionRepository
{
    public const API = 'https://api.stackexchange.com/questions?order=desc&sort=activity&filter=default&site=stackoverflow';
    private HttpClientInterface $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function getQuestionCollection(Filter $filter)
    {
        $route = self::API;

        $tagged = $filter->tagged()->taggedFilterFormat();
        $fromDate = $filter->dateFilter()->fromDateFilterFormat();
        $toDate = $filter->dateFilter()->toDateFilterFormat();

        $response = $this->client->request(
            'GET',
            $route . $tagged . $fromDate . $toDate
        );

        $statusCode = $response->getStatusCode();

        if (!in_array($statusCode, [200, 201])) {
            throw new StackOverflowApiServiceUnavailable();
        }

        $content = $response->toArray();

        return $content;
    }
}