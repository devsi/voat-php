<?php namespace Devsi\PhpVoat\Provider;

use Devsi\PhpVoat\Model;

/**
 *
 *
 * @author Simon Willan <simon.willan@googlemail.com>
 */
class SubmissionProvider extends Provider
{
    /**
     * Returns a list of 100 Voat front-page submissions
     *
     * @return Model\Submission[]
     * @version Legacy
     */
    public function getFrontpageSubmissions()
    {
        return $this->fetchData(Endpoints::LEGACY_FRONT_100, function ($data)
        {
            return $this->fromLegacyRaw($data);
        });
    }

    /**
     * Returns a list of 100 front-page submissions for a given subverse
     *
     * @param string $subverseName
     * @return Model\Submission[]
     * @version Legacy
     */
    public function getSubverseSubmissions($subverseName)
    {
        return $this->fetchData(Endpoints::LEGACY_SUBVERSE_FRONT_100 . $subverseName, function ($data)
        {
            return $this->fromLegacyRaw($data);
        });
    }

    /**
     * Returns a single Submission object of a given id
     *
     * @param int $id
     * @return Submission
     * @version Legacy
     */
    public function getSingleSubmission($id)
    {
        return $this->fetchData(Endpoints::LEGACY_SINGLE_SUBMISSION . $id, function($data)
        {
            return $this->fromLegacyRaw($data);
        });
    }

    /**
     * Returns a list of banned hostnames for submission links as array
     * Note: soon to be deprecated
     *
     * @return string[]
     * @throws \Devsi\PhpVoat\Exception\JsonResponseException
     * @version Legacy
     */
    public function getBannedHostnames()
    {
        $keys = array("Hostname", "reason", "added on", "added by");

        return $this->fetchData(Endpoints::LEGACY_BANNED_HOSTNAMES, function ($data) use ($keys)
        {
            return $this->formatLegacyVoatString($data, $keys);
        });
    }

    /**
     * Creates a new Submission from the raw content of a legacy API call.
     *
     * @param array $submission
     * @return Submission
     * @version Legacy
     */
    protected function fromLegacyRaw($submission)
    {
        $sub = new Model\Submission();

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