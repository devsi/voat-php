<?php namespace Devsi\PhpVoat;

use Devsi\PhpVoat\Core\Subverse;
use Devsi\PhpVoat\Core\VoatObject;
use GuzzleHttp\Client;

/**
 * Factory class for Voat Objects
 *
 * @author Simon Willan <simon.willan@googlemail.com>
 */
class PhpVoat
{
    public static function Subverse()
    {
        return new Subverse( static::GetClient() );
    }

    /**
     * Creates a new instance of Rest Client.
     *
     * @return Client
     */
    protected static function GetClient()
    {
        return new Client([
            "base_uri" => VoatObject::API_BASE . VoatObject::API_VER
        ]);
    }
}