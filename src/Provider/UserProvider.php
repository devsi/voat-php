<?php namespace Devsi\PhpVoat\Provider;

use Devsi\PhpVoat\Model;

/**
 *
 *
 * @author Simon Willan <simon.willan@googlemail.com>
 */
class UserProvider extends Provider
{
    /**
     * Returns a list of banned users on Voat.
     *
     * @return Model\User[]
     * @version Legacy
     */
    public function getBanned()
    {
        $keys = array("Username", "reason", "added on", "added by");

        return $this->fetchData(Endpoints::LEGACY_BANNED_USERS, function ($data) use ($keys)
        {
            // callback data is formatted for legacy api.
            $u = new Model\User();

            $data = $this->formatLegacyVoatString($data, $keys);

            $u->username = $data["Username"];
            $u->isBanned = true;
            $u->bannedReason = $data["reason"];
            $u->bannedOnDate = $data["added on"];
            $u->bannedByUser = $data["added by"];

            return $u;
        });
    }
}

