<?php namespace Devsi\PhpVoat\Model;

/**
 * Base class for all voat objects
 *
 * @author Simon Willan <simon.willan@googlemail.com>
 */
class VoatObject
{
    /**
     * Magic getter
     *
     * @param $property
     * @return mixed
     */
    public function __get($property) {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }

    /**
     * Magic setter
     *
     * @param $property
     * @param $value
     */
    public function __set($property, $value) {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        }
    }
}