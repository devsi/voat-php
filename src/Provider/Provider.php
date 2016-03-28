<?php namespace Devsi\PhpVoat\Provider;

use Devsi\PhpVoat\Contract\HttpClientInterface;
use Devsi\PhpVoat\Exception\JsonResponseException;
use Psr\Http\Message\ResponseInterface;

/**
 *
 *
 * @author Simon Willan <simon.willan@googlemail.com>
 */
abstract class Provider
{
    /**
     * @var HttpClientInterface
     */
    protected $httpClient;

    /**
     * If true, will return content as raw response string
     *
     * @var bool
     */
    protected $asRaw;

    /**
     * @param HttpClientInterface $httpClient
     */
    public function __construct(HttpClientInterface $httpClient, $asRaw = false)
    {
        $this->httpClient = $httpClient;
        $this->asRaw = $asRaw;
    }

    /**
     * Returns the rest client used for this object.
     *
     * @return HttpClientInterface
     */
    public function getHttpClient()
    {
        return $this->httpClient;
    }

    /**
     * Given a PSR7 response, retrieve the body contents.
     *
     * @param ResponseInterface $response
     * @return mixed
     * @throws \HttpException
     */
    protected function getResponseBody(ResponseInterface $response)
    {
        if ($response->getStatusCode() == 200)
        {
            return $response->getBody()->getContents();
        }
        return null;
    }

    /**
     * Decodes the http response string
     *
     * @param string $responseString
     * @return array
     * @throws JsonResponseException
     */
    protected function decodeResponse($responseString)
    {
        $output = json_decode($responseString, true);
        if (is_null($output))
            throw new JsonResponseException("Failed to decode json response.");
        return $output;
    }

    /**
     * Given an endpoint, will return data as formatted by $callback.
     * $callback is called once per item in the json_decoded response array.
     *
     * @param string $endpoint
     * @param callable $callback
     * @param bool $asRaw
     * @return mixed
     */
    protected function fetchData($endpoint, callable $callback, $asRaw = false)
    {
        $response = $this->getHttpClient()->get($endpoint);
        $raw = $this->getResponseBody($response);
        $output = array();

        // return raw?
        if ($asRaw || $this->asRaw)
            return $raw;

        // decode the response string
        $data = $this->decodeResponse($raw);

        // a simple associative array? Execute callback and return.
        if (count(array_filter(array_keys($data), 'is_string')) > 0)
            return $callback($data);

        // an array of data, iterate and execute callback.
        foreach($data as $string)
            $output[] = $callback($string);

        return $output;
    }

    /**
     * Voat legacy data is sometimes supplied as a string as follows:
     *
     *      "Username: pinky, reason: narf, added on: 1/8/2014 1:11:00pm, added by: brain"
     *
     * @param string $string
     * @param array $keys
     * @return array
     */
    protected function formatLegacyVoatString($string, $keys)
    {
        // due to slightly awkwardly formatted return data, we create a regex from a given array of keys
        $regex = array_reduce($keys, function ($carry, $item) {
            return $carry == "^" ? sprintf("%s%s:\\s?", $carry, $item) : sprintf("%s|,\\s?%s:\\s?", $carry, $item);
        }, '^');

        // use our regex to split the string in to its chunks
        $values = preg_split("/$regex/i", $string);

        // remove the first item due to the way i've written this regex.
        if (count($values) > 4)
            array_shift($values);

        return array_combine($keys, $values);
    }
}