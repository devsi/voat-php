<?php namespace Devsi\PhpVoatTests;

use Devsi\PhpVoat\PhpVoat;

/**
 * Test Voat submissions
 *
 * @author Simon Willan <simon.willan@googlemail.com>
 */
class SubverseTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function can_retrieve_default_subverses()
    {
        $subverse = PhpVoat::Subverse();
        $defaultSubverses = $subverse->getDefaultSubverses();

        // assert array
        $this->assertInternalType("array", $defaultSubverses);

        // assert objects are instance of Subverse
        if (count($defaultSubverses) > 0)
        {
            $single = $defaultSubverses[0];
            $this->assertInstanceOf("Devsi\\PhpVoat\\Core\\Subverse", $single);
        }
    }
}