<?php namespace Devsi\PhpVoatTests;

use Devsi\PhpVoat\PhpVoat;

/**
 * Test Voat submissions
 *
 * @author Simon Willan <simon.willan@googlemail.com>
 */
class SubmissionsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function can_retrieve_frontpage_submissions()
    {
        $submission = PhpVoat::submissions();
        $frontpage100 = $submission->getFrontpageSubmissions();

        // assert array
        $this->assertInternalType("array", $frontpage100);
        $this->assertIsSubmission($frontpage100);
    }

    /**
     * Asserts an array of Submissions
     * @param mixed
     */
    private function assertIsSubmission($test)
    {
        $single = null;
        // assert objects are instance of Submission
        if (is_array($test))
        {
            if (count($test) > 0)
                $single = $test[0];
        } else
            $single = $test;

        $this->assertInstanceOf("Devsi\\PhpVoat\\Core\\Submission", $single);
    }
}