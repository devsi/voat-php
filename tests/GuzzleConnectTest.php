<?php namespace Devsi\PhpVoatTests;

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
    public function voat_object_guzzle_injected()
    {
        $voatRestClient = PhpVoat::Subverse()->getRestClient();
        $this->assertInstanceOf("GuzzleHttp\\Client", $voatRestClient);
    }
}