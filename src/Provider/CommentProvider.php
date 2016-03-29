<?php namespace Devsi\PhpVoat\Provider;

use Devsi\PhpVoat\Model;

/**
 *
 *
 * @author Simon Willan <simon.willan@googlemail.com>
 */
class CommentProvider extends Provider
{
    /**
     * Returns a single Comment object of a given id
     *
     * @param int $id
     * @return Model\Comment
     * @version Legacy
     */
    public function getSingleComment($id)
    {
        return $this->fetchData(Endpoints::LEGACY_SINGLE_COMMENT . $id, function($data)
        {
            return $this->fromLegacyRaw($data);
        });
    }


    /**
     * Returns all comments for a given submission
     *
     * @param int $submissionId
     * @return Model\Comment[]
     * @version Legacy
     */
    public function getAllForSubmission($submissionId)
    {
        return $this->fetchData(Endpoints::LEGACY_SUBMISSION_COMMENTS . $submissionId, function($data)
        {
            var_dump($data);
        }, true);
    }

    /**
     * Creates a new Comment from the raw content of a legacy API call.
     *
     * @param array $data
     * @return Model\Comment
     * @version Legacy
     */
    protected function fromLegacyRaw($data)
    {
        $comment = new Model\Comment();

        $comment->id = $data[ "Id" ];
        $comment->subverseId = $data[ "MessageId" ];
        $comment->parentId = $data[ "ParentId" ];
        $comment->content = $data[ "CommentContent" ];
        $comment->postedBy = $data[ "Name" ];
        $comment->datePosted = $data[ "Date" ];
        $comment->dateEdited = $data[ "LastEditDate" ];
        $comment->likes = $data[ "Likes" ];
        $comment->dislikes = $data[ "Dislikes" ];

        return $comment;
    }
}