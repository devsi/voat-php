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
     *
     * @return BannedUser[]
     */
    public function getAll()
    {
        $bannedUsers = array();

        $response = $this->getRestClient()->get(Endpoints::LEGACY_BANNED_USERS);

        $users = $this->getResponseBody($response);

        if (is_array($users))
        {
            // build array of banned users
            foreach($users as $string_to_split)
            {
                $u = new BannedUser($this->getRestClient());
                $data = $this->formatBannedUserString($string_to_split);

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
     * Voat banned user info is a string supplied as follows:
     *
     *      "Username: pinky, reason: narf, added on: 1/8/2014 1:11:00pm, added by: brain"
     *
     * @param $string
     * @return array
     */
    private function formatBannedUserString($string)
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