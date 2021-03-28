<?php

namespace App\Tests;

use App\StackOverflow\Infrastructure\StackOverflowApiQuestionRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpClient\HttpClient;

class StackOverflowApiControllerTest extends WebTestCase
{
    /**
     * @test
     */
    public function shouldGet200StatusCodeForLocalApiWithSymfonyTaggedFilter()
    {
        $client = static::createClient();

        $client->request('GET', '/api?tagged=symfony');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    /**
     * @test
     */
    public function shouldGet200StatusCodeForLocalApiWithSymfonyTaggedFilterWithOptionalFilters()
    {
        $client = static::createClient();

        $optionalFilters = '&from_date=2021-03-01&to_date=2021-03-10';

        $client->request('GET', '/api?tagged=symfony' . $optionalFilters);

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    /**
     * @test
     */
    public function shouldGet500StatusCodeIfTaggedFilterIsEmpty()
    {
        $client = static::createClient();

        $client->request('GET', '/api');

        $this->assertEquals(500, $client->getResponse()->getStatusCode());
    }

    /**
     * @test
     */
    public function shouldGetTheSameQuestionCollectionResponseAsTheStackOverflowApi()
    {
        $SYMFONY_TAGGED_FILTER = 'tagged=symfony';

        $client = static::createClient();
        $client->request('GET', '/api?' . $SYMFONY_TAGGED_FILTER);

        $externalClient = HttpClient::create();
        $stackOverFlowApiRoute = StackOverflowApiQuestionRepository::API;
        $stackOverFlowResponse = $externalClient->request(
            'GET',
            $stackOverFlowApiRoute . '&' . $SYMFONY_TAGGED_FILTER
        );

        $this->assertEquals(
            $stackOverFlowResponse->toArray()['items'],
            json_decode($client->getResponse()->getContent(), true)['items']
        );
    }
}