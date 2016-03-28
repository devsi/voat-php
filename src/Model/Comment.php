<?php namespace Devsi\PhpVoat\Model;

/**
 * @property int    $id
 * @property int    $subverseId
 * @property int    $parentId
 * @property string $content
 * @property string $postedBy
 * @property string $datePosted
 * @property string $dateEdited
 * @property int    $likes
 * @property int    $dislikes
 *
 * @author Simon Willan <simon.willan@googlemail.com>
 */
class Comment extends VoatObject
{
    protected $id;
    protected $subverseId;
    protected $parentId;
    protected $content;

    protected $postedBy;
    protected $datePosted;
    protected $dateEdited;

    protected $likes;
    protected $dislikes;
}