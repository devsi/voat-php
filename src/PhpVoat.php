<?php namespace Devsi\PhpVoat;

use Devsi\PhpVoat\Provider;
use Devsi\PhpVoat\Adapter\GuzzleHttpClient;
use Devsi\PhpVoat\Contract\HttpClientInterface;

/**
 * Accessor class for all Voat objects
 *
 * @author Simon Willan <simon.willan@googlemail.com>
 */
class PhpVoat
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
     * Return an object that can provide Subverse data.
     *
     * @param bool $returnRaw
     * @return Provider\SubverseProvider
     */
    public function subverse($returnRaw = false)
    {
        return new Provider\SubverseProvider( static::getHttpClient(), $returnRaw );
    }

    /**
     * Returns an object that can provide User data.
     *
     * @param bool $returnRaw
     * @return Provider\UserProvider
     */
    public function user($returnRaw = false)
    {
        return new Provider\UserProvider( static::getHttpClient(), $returnRaw );
    }

    /**
     * Returns an object that can provide Submission data
     *
     * @param bool $returnRaw
     * @return Provider\SubmissionProvider
     */
    public function submission($returnRaw = false)
    {
        return new Provider\SubmissionProvider( static::getHttpClient(), $returnRaw );
    }

    /**
     * Returns an object that can provide Comment data
     *
     * @param bool $returnRaw
     * @return Provider\CommentProvider
     */
    public function comment($returnRaw = false)
    {
        return new Provider\CommentProvider( static::getHttpClient(), $returnRaw );
    }


    /**
     * Creates a new instance of Http Client.
     *
     * @return HttpClientInterface
     */
    public static function getHttpClient()
    {
        return new GuzzleHttpClient([
            "base_uri" => static::API_BASE . static::API_VER
        ]);
    }
}