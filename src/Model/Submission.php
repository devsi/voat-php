<?php namespace Devsi\PhpVoat\Model;

/**
 * @property int $id
 * @property string $title
 * @property string $linkDescription
 * @property string $content
 * @property int $type
 * @property string $subverse
 * @property string $postedBy
 * @property string $datePosted
 * @property string $dateEdited
 * @property float $rankValue
 * @property string $thumbnailUrl
 * @property int $likes
 * @property int $dislikes
 * @property int $commentCount
 *
 * @author Simon Willan <simon.willan@googlemail.com>
 */
class Submission extends VoatObject
{
    protected $id;
    protected $title;
    protected $linkDescription;
    protected $content;

    protected $type;
    protected $subverse;

    protected $postedBy;
    protected $datePosted;
    protected $dateEdited;

    protected $rankValue;
    protected $thumbnailUrl;
    protected $likes;
    protected $dislikes;
    protected $commentCount;
}