<?php namespace Devsi\PhpVoat\Provider;

use Devsi\PhpVoat\Model;

/**
 *
 *
 * @author Simon Willan <simon.willan@googlemail.com>
 */
class SubverseProvider extends Provider
{
    /**
     * Returns a list of default subverses shown to guests
     *
     * @return Model\Subverse[]
     * @version Legacy
     */
    public function getDefaultSubverses()
    {
        return $this->fetchData(Endpoints::LEGACY_DEFAULT_SUBVERSES, function ($data)
        {
            // callback data providers a name only.
            $subverse = new Model\Subverse();

            $subverse->name = $data;

            return $subverse;
        });
    }

    /**
     * Returns a list of the top 200 subverses
     *
     * @returns Model\Subverse[]
     * @version Legacy
     */
    public function getTop200Subverses()
    {
        $keys = array("Name", "Description", "Subscribers", "Created");

        return $this->fetchData(Endpoints::LEGACY_TOP200_SUBVERSES, function ($data) use($keys)
        {
            // callback data is formatted for legacy api.
            $subverse = new Model\Subverse();
            $data = $this->formatLegacyVoatString($data, $keys);

            $subverse->name = $data['Name'];
            $subverse->description = $data['Description'];
            $subverse->subscriberCount = $data["Subscribers"];
            $subverse->createdOn = $data["Created"];

            return $subverse;
        });
    }
}