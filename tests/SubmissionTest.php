<?php namespace Devsi\PhpVoatTests;

use Devsi\PhpVoat\PhpVoat;

/**
 * Test Voat single submission
 *
 * @author Simon Willan <simon.willan@googlemail.com>
 */
class SubmissionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function can_retrieve_a_list_of_banned_hostnames()
    {
        $submission = PhpVoat::submission();
        $bannedHostnames = $submission->getBannedHostnames();

        // assert array
        $this->assertInternalType("array", $bannedHostnames);
    }
}