<?php namespace Devsi\PhpVoat\Core;

/**
 *
 *
 * @author Simon Willan <simon.willan@googlemail.com>
 */
class Submissions extends VoatObject
{
    /**
     * Returns a list of 100 Voat front-page submissions
     * Notes: soon to be deprecated
     *
     * @return Submission[]
     */
    public function getFrontpageSubmissions()
    {
        $submissions = $this->fetchData(Endpoints::LEGACY_FRONT_100, function ($data) {
            return $this->submissionFromLegacyRaw($data);
        });

        return $submissions;
    }

    /**
     * Returns a list of 100 front-page submissions for a given subverse
     * Notes: soon to be deprecated
     *
     * @param string $subverse_name
     * @return Submission[]
     */
    public function getSubverseSubmissions($subverse_name)
    {
        $submissions = $this->fetchData(Endpoints::LEGACY_SUBVERSE_FRONT_100 . $subverse_name, function ($data) {
            return $this->submissionFromLegacyRaw($data);
        });

        return $submissions;
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