<?php namespace Devsi\PhpVoat\Model;

/**
 * @property string $username
 * @property bool   $isBanned;
 * @property string $bannedReason;
 * @property string $bannedOnDate;
 * @property string $bannedByUser;
 *
 * @author Simon Willan <simon.willan@googlemail.com>
 */
class User extends VoatObject
{
    protected $username;

    protected $isBanned = false;
    protected $bannedReason;
    protected $bannedOnDate;
    protected $bannedByUser;
}