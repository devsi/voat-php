<?php namespace Devsi\PhpVoat\Model;

/**
 * @property string $username
 * @property string $dateRegistered;
 * @property int    $commentContributionPoints;
 * @property int    $submissionContributionPoints;
 * @property array  $badges;
 * @property bool   $isBanned
 * @property string $bannedReason
 * @property string $bannedOnDate
 * @property string $bannedByUser
 *
 * @author Simon Willan <simon.willan@googlemail.com>
 */
class User extends VoatObject
{
    protected $username;
    protected $dateRegistered;
    protected $commentContributionPoints;
    protected $submissionContributionPoints;
    protected $badges;

    protected $isBanned = false;
    protected $bannedReason;
    protected $bannedOnDate;
    protected $bannedByUser;
}