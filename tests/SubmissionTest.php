<?php namespace Devsi\PhpVoatTests;

use Devsi\PhpVoat\Core\Submission;
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
        $hostnames = PhpVoat::submission()->getBannedHostnames();
        $this->assertInternalType("array", $hostnames);
    }

    /**
     * @test
     */
    public function can_retreive_a_single_submission()
    {
        $submission = PhpVoat::submission()->getSingleSubmission(123456);
        $this->assertInstanceOf(Submission::class, $submission);
    }
}