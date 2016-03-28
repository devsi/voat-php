<?php namespace Devsi\PhpVoat\Core;

/**
 *
 *
 * @author Simon Willan <simon.willan@googlemail.com>
 */
class Subverse extends VoatObject
{
    protected $name;
    protected $description;
    protected $subscriberCount;
    protected $createdOn;

    /**
     * Returns a list of default subverses shown to guests
     * Note: soon to be deprecated
     *
     * @return Subverse[]
     * @throws \Devsi\PhpVoat\Exception\JsonResponseException
     */
    public function getDefaultSubverses()
    {
        $subverses = array();

        $response = $this->getHttpClient()->get(Endpoints::LEGACY_DEFAULT_SUBVERSES);

        $raw_subverse_names = $this->getResponseBody($response);

        if (is_array($raw_subverse_names))
        {
            // build an array of subverses
            foreach ($raw_subverse_names as $name)
            {
                $subverse = new Subverse($this->getHttpClient());
                $subverse->name = $name;

                $subverses[] = $subverse;
            }
        } else {
            // return raw
            return $raw_subverse_names;
        }

        return $subverses;
    }

    /**
     * Returns a list of the top 200 subverses
     * Notes: soon to be deprecated
     *
     * @returns Subverse[]
     * @throws \Devsi\PhpVoat\Exception\JsonResponseException
     */
    public function getTop200Subverses()
    {
        $subverses = array();

        $response = $this->getHttpClient()->get(Endpoints::LEGACY_TOP200_SUBVERSES);

        $raw_subverses = $this->getResponseBody($response);

        if (is_array($raw_subverses))
        {
            $subverse_keys = array("Name", "Description", "Subscribers", "Created");

            // build an array of subverses
            foreach ($raw_subverses as $string_to_split)
            {
                $subverse = new Subverse($this->getHttpClient());
                $data = $this->formatLegacyVoatString($string_to_split, $subverse_keys);

                $subverse->name = $data['Name'];
                $subverse->description = $data['Description'];
                $subverse->subscriberCount = $data["Subscribers"];
                $subverse->createdOn = $data["Created"];

                $subverses[] = $subverse;
            }
        } else
        {
            return $raw_subverses;
        }

        return $subverses;
    }
}