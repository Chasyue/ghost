<?php
namespace FOS\MessageBundle\Security;

use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Ghost\PostBundle\Security\AuthenticatorInterface;
use Ghost\PostBundle\Entity\User;

/**
 * @author Wenming Tang <tang@babyfamily.com>
 */
class Authenticator implements AuthenticatorInterface
{
    /**
     * The security context
     *
     * @var SecurityContextInterface
     */
    protected $securityContext;

    /**
     * @param SecurityContextInterface $securityContext
     */
    public function __construct(SecurityContextInterface $securityContext)
    {
        $this->securityContext = $securityContext;
    }

    /**
     * {@inheritDoc}
     */
    public function getAuthenticatedUser()
    {
        $user = $this->securityContext->getToken()->getUser();

        if (!$user instanceof User) {
            throw new AccessDeniedException('Must be logged in with a User instance');
        }

        return $user;
    }
}