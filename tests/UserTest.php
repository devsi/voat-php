<?php namespace Devsi\PhpVoatTests;

use Devsi\PhpVoat\PhpVoat;

/**
 * Test Voat submissions
 *
 * @author Simon Willan <simon.willan@googlemail.com>
 */
class UserTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function can_retrieve_banned_users()
    {
        $bannedUser = PhpVoat::BannedUser();
        $banned = $bannedUser->getAll();

        // assert array
        $this->assertInternalType("array", $banned);

        // assert objects are instance of BannedUser
        if (count($banned) > 0 )
        {
            $single = $banned[0];
            $this->assertInstanceOf("Devsi\\PhpVoat\\Core\\BannedUser", $single);
        }
    }
}