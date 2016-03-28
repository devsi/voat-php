<?php namespace Devsi\PhpVoat\Core;

/**
 *
 *
 * @author Simon Willan <simon.willan@googlemail.com>
 */
class BannedUser extends User
{
    protected $reason;
    protected $banned_on_date;
    protected $banned_by_user;

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
                $u->banned_on_date = $data["added on"];
                $u->banned_by_user = $data["added by"];

                $bannedUsers[] = $u;
            }
        } else {
            // return raw
            return $users;
        }

        return $bannedUsers;
    }

    /**
     * Returns the reason this user was banned.
     *
     * @return string
     */
    public function getReason()
    {
        return $this->reason;
    }

    /**
     * Returns the date this user was banned.
     *
     * @return string
     */
    public function getBannedOnDate()
    {
        return $this->banned_on_date;
    }

    /**
     * Returns the username of the administrator who banned this user.
     *
     * @return string
     */
    public function getBannedByUser()
    {
        return $this->banned_by_user;
    }
}