<?php namespace Devsi\PhpVoat\Core;

/**
 *
 *
 * @author Simon Willan <simon.willan@googlemail.com>
 */
class Subverse extends VoatObject
{
    protected $name;

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

        $response = $this->restClient->get(Endpoints::LEGACY_DEFAULT_SUBVERSES);

        $raw_subverse_names = $this->getResponseBody($response);

        if ($raw_subverse_names)
        {
            // build an array of subverses
            foreach ($raw_subverse_names as $name)
            {
                $subverse = new Subverse($this->getRestClient());
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
     * Return the name of the subverse
     *
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }
}