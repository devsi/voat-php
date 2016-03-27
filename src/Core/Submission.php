<?php namespace Devsi\PhpVoat\Core;

/**
 *
 *
 * @author Simon Willan <simon.willan@googlemail.com>
 */
class Submission extends VoatObject
{
    /**
     * Returns a list of banned hostnames for submission links as array
     *
     * @return string[]
     * @throws \Devsi\PhpVoat\Exception\JsonResponseException
     */
    public function getBannedHostnames()
    {
        $response = $this->getRestClient()->get(Endpoints::LEGACY_BANNED_HOSTNAMES);
        $bannedHostnames = $this->getResponseBody($response);

        return $bannedHostnames;
    }
}