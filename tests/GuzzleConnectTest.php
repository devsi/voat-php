<?php namespace Devsi\PhpVoatTests;

use Devsi\PhpVoat\Exception\TooManyRequestsException;
use Devsi\PhpVoat\Contract\HttpClientInterface;
use Devsi\PhpVoat\PhpVoat;
use GuzzleHttp\Client;

/**
 * Test Guzzle connection
 *
 * @author Simon Willan <simon.willan@googlemail.com>
 */
class GuzzleConnectTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function phpunit_works()
    {
        $this->assertEquals(true, true);
    }

    /**
     * @test
     */
    public function guzzle_can_connect()
    {
        $client = new Client([
            'base_uri' => 'http://httpbin.org/'
        ]);

        $response = $client->get('get');
        $this->assertEquals(200, $response->getStatusCode());
    }

    /**
     * @test
     */
    public function too_many_requests_to_voat_api()
    {
        $this->expectException(TooManyRequestsException::class);

        $httpClient = PhpVoat::getHttpClient();
        $httpClient->get("frontpage");
        $httpClient->get("frontpage");
        $httpClient->get("frontpage");
    }

    /**
     * @test
     */
    public function voat_object_http_client_injected()
    {
        $httpClient = PhpVoat::getHttpClient();
        $this->assertInstanceOf(HttpClientInterface::class, $httpClient);
    }
}
