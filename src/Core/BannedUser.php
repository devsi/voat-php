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
     * @throws \Devsi\PhpVoat\Exception\JsonResponseException
     */
    public function getAll()
    {
        $bannedUsers = array();

        $response = $this->getHttpClient()->get(Endpoints::LEGACY_BANNED_USERS);

        $users = $this->getResponseBody($response);

        if (is_array($users))
        {
            $keys = array("Username", "reason", "added on", "added by");

            // build array of banned users
            foreach($users as $string_to_split)
            {
                $u = new BannedUser($this->getHttpClient());

                $data = $this->formatLegacyVoatString($string_to_split, $keys);

                $u->username = $data["Username"];
                $u->reason = $data["reason"];
                $u->bannedOnDate = $data["added on"];
                $u->bannedByUser = $data["added by"];

                $bannedUsers[] = $u;
            }
        } else
        {
            // return raw
            return $users;
        }

        return $bannedUsers;
    }
}