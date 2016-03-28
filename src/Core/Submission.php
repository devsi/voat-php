<?php namespace Devsi\PhpVoat\Core;

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


    /**
     * Returns a list of banned hostnames for submission links as array
     * Note: soon to be deprecated
     *
     * @return string[]
     * @throws \Devsi\PhpVoat\Exception\JsonResponseException
     */
    public function getBannedHostnames()
    {
        $response = $this->getHttpClient()->get(Endpoints::LEGACY_BANNED_HOSTNAMES);
        $bannedHostnames = $this->getResponseBody($response);

        return $bannedHostnames;
    }

    /**
     * Returns a single submission object of a given id
     * Note: soon to be deprecated
     *
     * @param int $id
     * @return Submission
     */
    public function getSingleSubmission($id)
    {
        $submission = $this->fetchData(Endpoints::LEGACY_SINGLE_SUBMISSION . $id, function($data) {
            return $this->submissionFromLegacyRaw($data);
        });

        return $submission;
    }

    /**
     * Creates a new Submission from the raw content of a legacy API call.
     *
     * @param array $submission
     * @return Submission
     */
    private function submissionFromLegacyRaw($submission)
    {
        $sub = new Submission($this->getHttpClient());

        $sub->id = $submission["Id"];
        $sub->title = $submission["Title"];
        $sub->linkDescription = $submission["Linkdescription"];
        $sub->content = $submission["MessageContent"];
        $sub->type = $submission["Type"];
        $sub->subverse = $submission["Subverse"];
        $sub->postedBy = $submission["Name"];
        $sub->datePosted = $submission["Date"];
        $sub->dateEdited = $submission["LastEditDate"];
        $sub->rankValue = $submission["Rank"];
        $sub->thumbnailUrl = $submission["Thumbnail"];
        $sub->likes = $submission["Likes"];
        $sub->dislikes = $submission["Dislikes"];
        $sub->commentCount = $submission["CommentCount"];

        return $sub;
    }
}