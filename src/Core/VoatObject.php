<?php namespace Devsi\PhpVoat\Core;

use Devsi\PhpVoat\Contract\HttpClientInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Base class for all voat objects
 *
 * @author Simon Willan <simon.willan@googlemail.com>
 */
class VoatObject
{
    /**
     * URI base for Voat API.
     */
    const API_BASE = "https://voat.co/api/";

    /**
     * Voat API version number.
     * Not implemented until new Voat API is released.
     */
    const API_VER = "";

    /**
     * Set to true if wrapper must return raw API body.
     *
     * @var bool
     */
    protected $use_raw = false;

    /**
     * @var HttpClientInterface
     */
    protected $httpClient;

    public function __construct(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
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
     * Magic getter
     *
     * @param $property
     * @return mixed
     */
    public function __get($property) {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }

    /**
     * Magic setter
     *
     * @param $property
     * @param $value
     */
    public function __set($property, $value) {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        }
    }

    /**
     * Given a PSR7 response, retrieve the body contents.
     *
     * @param ResponseInterface $response
     * @return mixed
     * @throws JsonResponseException
     */
    protected function getResponseBody(ResponseInterface $response)
    {
        $output = null;

        if ($response->getStatusCode() == 200)
        {
            $raw = $response->getBody()->getContents();

            // return raw body
            if ($this->use_raw)
                return $raw;

            $output = json_decode($raw, true);
            if (is_null($output))
                throw new JsonResponseException("Failed to decode json response.");
        }

        return $output;
    }

    /**
     * Given an endpoint, will return data as formatted by $callback.
     * $callback is called once per item in the json_decoded response array.
     *
     * @param string $endpoint
     * @param callable $callback
     * @return mixed
     */
    protected function fetchData($endpoint, callable $callback)
    {
        $response = $this->getHttpClient()->get($endpoint);
        $rawData = $this->getResponseBody($response);

        $output = array();

        if (is_array($rawData))
        {
            foreach($rawData as $data)
            {
                $output[] = $callback($data);
            }
        } else
        {
            return $rawData;
        }

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