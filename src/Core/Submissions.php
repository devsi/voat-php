<?php namespace Devsi\PhpVoat\Core;

/**
 *
 *
 * @author Simon Willan <simon.willan@googlemail.com>
 */
class Submissions extends VoatObject
{
    public function getFrontpageSubmissions()
    {
        $submissions = array();

        $response = $this->getHttpClient()->get(Endpoints::LEGACY_FRONT_100);

        $raw_submissions = $this->getResponseBody($response);

        if (is_array($raw_submissions))
        {
            foreach($raw_submissions as $submission)
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

                $submissions[] = $sub;
            }
        } else
        {
            return $raw_submissions;
        }

        return $submissions;
    }
}