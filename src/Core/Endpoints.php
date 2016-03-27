<?php namespace Devsi\PhpVoat\Core;

/**
 * A static class defining known Voat endpoints
 *
 * @author Simon Willan <simon.willan@googlemail.com>
 */
class Endpoints
{
    const LEGACY_DEFAULT_SUBVERSES = "defaultsubverses";
    const LEGACY_BANNED_HOSTNAMES = "bannedhostnames";
    const LEGACY_TOP200_SUBVERSES = "top200subverses";
    const LEGACY_FRONT_100 = "frontpage";
    const LEGACY_SUBVERSE_FRONT_100 = "subversefrontpage?subverse=";
    const LEGACY_SINGLE_SUBMISSION = "singlesubmission?id=";
    const LEGACY_SUBMISSION_COMMENTS = "submissioncomments?submissionId=";
    const LEGACY_SINGLE_COMMENT = "singlecomment?id=";
    const LEGACY_SUBVERSE_INFO = "subverseinfo?subverseName=";
    const LEGACY_USER_INFO = "userinfo?userName=";
    const LEGACY_BADGE_INFO = "badgeinfo?badgeId=";
}