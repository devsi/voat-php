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
     * Returns a single User object, given a username.
     *
     * @param string $username
     * @return Model\User
     * @version Legacy
     */
    public function getSingleUser($username)
    {
        return $this->fetchData(Endpoints::LEGACY_USER_INFO . $username, function ($data)
        {
            $user = new Model\User();

            $user->username = $data["Name"];
            $user->dateRegistered = $data["RegistrationDate"];
            $user->commentContributionPoints = $data["CCP"];
            $user->submissionContributionPoints = $data["LCP"];
            $user->badges = $data["Badges"];

            return $user;
        });
    }

    /**
     * Returns a single Badge object, given a badge name.
     *
     * @param string $badgeName
     * @return Model\Badge
     * @version Legacy
     */
    public function getSingleBadge($badgeName)
    {
        return $this->fetchData(Endpoints::LEGACY_BADGE_INFO . $badgeName, function ($data)
        {
            $badge = new Model\Badge();

            $badge->id = $data["BadgeId"];
            $badge->name = $data["Name"];
            $badge->description = $data["Title"];
            $badge->graphic= $data["BadgeGraphics"];

            return $badge;
        });
    }

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
            $user = new Model\User();

            $data = $this->formatLegacyVoatString($data, $keys);

            $user->username = $data["Username"];
            $user->isBanned = true;
            $user->bannedReason = $data["reason"];
            $user->bannedOnDate = $data["added on"];
            $user->bannedByUser = $data["added by"];

            return $user;
        });
    }
}

