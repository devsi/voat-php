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
     */
    public function getDefaultSubverses()
    {
        $subverses = $this->fetchData(Endpoints::LEGACY_DEFAULT_SUBVERSES, function ($data) {
            $subverse = new Subverse($this->getHttpClient());
            $subverse->name = $data;

            return $subverse;
        });

        return $subverses;
    }

    /**
     * Returns a list of the top 200 subverses
     * Notes: soon to be deprecated
     *
     * @returns Subverse[]
     */
    public function getTop200Subverses()
    {
        $keys = array("Name", "Description", "Subscribers", "Created");

        $subverses = $this->fetchData(Endpoints::LEGACY_TOP200_SUBVERSES, function ($data) use($keys)
        {
            $subverse = new Subverse($this->getHttpClient());
            $data = $this->formatLegacyVoatString($data, $keys);

            $subverse->name = $data['Name'];
            $subverse->description = $data['Description'];
            $subverse->subscriberCount = $data["Subscribers"];
            $subverse->createdOn = $data["Created"];

            return $subverse;
        });

        return $subverses;
    }
}