<?php namespace Devsi\PhpVoat\Adapter;

use Devsi\PhpVoat\Contract\HttpClientInterface;
use Devsi\PhpVoat\Exception\TooManyRequestsException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

/**
 * An adapter

 *
*@author Simon Willan <simon.willan@googlemail.com>
 */
class GuzzleHttpClient implements HttpClientInterface
{
    /**
     * @var \GuzzleHttp\Client
     */
    protected $client;

    /**
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        $this->client = new Client($config);
    }

    /**
     * Http client HTTP GET request. Returns a PSR7 Response
     *
     * @param string $uri
     * @param array $options
     * @return \Psr\Http\Message\ResponseInterface
     * @throws TooManyRequestsException
     * @throws \Exception
     */
    public function get($uri = null, array $options = [])
    {
        try {
            return $this->client->get( $uri, $options );
        } catch (ClientException $e)
        {
            if ($e->getCode() == 429)
                throw new TooManyRequestsException($e->getMessage(), $e->getCode());
            else
                throw new \Exception($e->getMessage(), $e->getCode());
        }
    }
}