<?php namespace Devsi\PhpVoat;

use Devsi\PhpVoat\Core\BannedUser;
use Devsi\PhpVoat\Core\Submission;
use Devsi\PhpVoat\Core\Submissions;
use Devsi\PhpVoat\Core\Subverse;
use Devsi\PhpVoat\Core\VoatObject;
use Devsi\PhpVoat\Adapter\GuzzleHttpClient;
use Devsi\PhpVoat\Contract\HttpClientInterface;

/**
 * Factory class for Voat Objects
 *
 * @author Simon Willan <simon.willan@googlemail.com>
 */
class PhpVoat
{
    /**
     * Get Subverse object.
     *
     * @return Subverse
     */
    public static function subverse()
    {
        return new Subverse( static::getHttpClient() );
    }

    /**
     * Get Submission object.
     *
     * @return Submission
     */
    public static function submission()
    {
        return new Submission( static::getHttpClient() );
    }

    /**
     * Get Submissions object.
     *
     * @return Submissions
     */
    public static function submissions()
    {
        return new Submissions( static::getHttpClient() );
    }

    /**
     * Get a BannedUser object.
     *
     */
    public static function bannedUser()
    {
        return new BannedUser( static::getHttpClient() );
    }

    /**
     * Creates a new instance of Http Client.
     *
     * @return HttpClientInterface
     */
    public static function getHttpClient()
    {
        return new GuzzleHttpClient([
            "base_uri" => VoatObject::API_BASE . VoatObject::API_VER
        ]);
    }
}