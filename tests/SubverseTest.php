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
        $this->assertIsSubverse($defaultSubverses);
    }

    /**
     * @test
     */
    public function can_retrieve_top_200_subverses()
    {
        $subverse = PhpVoat::Subverse();
        $top200 = $subverse->getTop200Subverses();

        // assert array
        $this->assertInternalType("array", $top200);
        $this->assertIsSubverse($top200);
    }

    /**
     * Asserts an array of subverses
     * @param mixed
     */
    private function assertIsSubverse($test)
    {
        $single = null;
        // assert objects are instance of Subverse
        if (is_array($test))
        {
            if (count($test) > 0)
                $single = $test[0];
        } else
            $single = $test;

        $this->assertInstanceOf("Devsi\\PhpVoat\\Core\\Subverse", $single);
    }
}