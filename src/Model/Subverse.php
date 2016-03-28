<?php namespace Devsi\PhpVoat\Model;

/**
 * @property string $name
 * @property string $description
 * @property string $url
 * @property string $sidebarInfo
 * @property string $type
 * @property bool   $ratedAdult
 * @property string $createdOn
 * @property int    $subscriberCount
 *
 * @author Simon Willan <simon.willan@googlemail.com>
 */
class Subverse extends VoatObject
{
    protected $name;
    protected $description;
    protected $url;
    protected $sidebarInfo;

    protected $type;
    protected $ratedAdult;
    protected $createdOn;
    protected $subscriberCount;
}