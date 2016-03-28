<?php namespace Devsi\PhpVoat\Core;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
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
     * @var Client
     */
    protected $restClient;

    public function __construct(Client $restClient)
    {
        $this->restClient = $restClient;
    }

    /**
     * Returns the rest client used for this object.
     *
     * @return Client
     */
    public function getRestClient()
    {
        return $this->restClient;
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

            $output = json_decode($raw);
            if (is_null($output))
                throw new JsonResponseException("Failed to decode json response.");
        }

        return $output;
    }

    /**
     * Voat legacy data is sometimes supplied as a string as follows:
     *
     *      "Username: pinky, reason: narf, added on: 1/8/2014 1:11:00pm, added by: brain"
     *
     * @param $string
     * @return array
     */
    protected function formatLegacyVoatString($string)
    {
        $output = array();

        $pairs = explode(",", $string);
        foreach ($pairs as $pair)
        {
            list($key, $value) = explode(":", $pair, 2);
            $output[trim($key)] = trim($value);
        }

        return $output;
    }
}