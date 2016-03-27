<?php namespace Devsi\PhpVoat\Core;
use Devsi\PhpVoat\Exception\JsonResponseException;

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
     * @throws JsonResponseException
     */
    public function getDefaultSubverses()
    {
        $subverses = array();

        $response = $this->restClient->get(Endpoints::LEGACY_DEFAULT_SUBVERSES);

        if ($response->getStatusCode() == 200)
        {
            $raw_subverse_names = $this->getResponseBody($response);

            // build an array of subverses
            foreach ($raw_subverse_names as $name)
            {
                $subverse = new Subverse($this->getRestClient());
                $subverse->name = $name;

                $subverses[] = $subverse;
            }
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