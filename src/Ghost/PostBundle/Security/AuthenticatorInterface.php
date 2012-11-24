<?php
namespace Ghost\PostBundle\Security;

use Ghost\PostBundle\Entity\User;

/**
 * @author Wenming Tang <tang@babyfamily.com>
 */
interface AuthenticatorInterface
{
    /**
     * Gets the current authenticated user
     *
     * @return User
     */
    function getAuthenticatedUser();
}