<?php namespace Cviebrock\LaravelElasticsearch\Tests;

use Cviebrock\LaravelElasticsearch\Factory;
use Cviebrock\LaravelElasticsearch\Manager;
use Elasticsearch;
use Elastic\Elasticsearch\Client;


class ServiceProviderTests extends TestCase
{

    public function testAbstractsAreLoaded(): void
    {
        $factory = app('elasticsearch.factory');
        $this->assertInstanceOf(Factory::class, $factory);

        $manager = app('elasticsearch');
        $this->assertInstanceOf(Manager::class, $manager);

        $client = app(Client::class);
        $this->assertInstanceOf(Client::class, $client);
    }

    /**
     * Test that the facade works.
     * @todo This seems a bit simplistic ... maybe a better way to do this?
     */
    public function testFacadeWorks(): void
    {
        $response = Elasticsearch::ping();

        $this->assertTrue($response->getStatusCode() === 200);
    }

    /**
     * Test we can get the ES info.
     */
    public function testInfoWorks(): void
    {
        $info = Elasticsearch::info();

        $this->assertInstanceOf(\Elastic\Elasticsearch\Response\Elasticsearch::class, $info);
        $this->assertArrayHasKey('cluster_name', $info);
    }
}
