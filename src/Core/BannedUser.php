<?php namespace Devsi\PhpVoat\Core;

/**
 * @property string $reason;
 * @property string $bannedOnDate;
 * @property string $bannedByUser;
 *
 * @author Simon Willan <simon.willan@googlemail.com>
 */
class BannedUser extends User
{
    protected $reason;
    protected $bannedOnDate;
    protected $bannedByUser;

    /**
     * Returns a list of banned users on Voat.
     * Note: soon to be deprecated
     *
     * @return BannedUser[]
     */
    public function getAll()
    {
        $keys = array("Username", "reason", "added on", "added by");

        $bannedUsers = $this->fetchData(Endpoints::LEGACY_BANNED_USERS, function ($data) use ($keys)
        {
            $u = new BannedUser($this->getHttpClient());

            $data = $this->formatLegacyVoatString($data, $keys);

            $u->username = $data["Username"];
            $u->reason = $data["reason"];
            $u->bannedOnDate = $data["added on"];
            $u->bannedByUser = $data["added by"];

            return $u;
        });

        return $bannedUsers;
    }
}