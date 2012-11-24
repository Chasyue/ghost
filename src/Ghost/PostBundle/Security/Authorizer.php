<?php
namespace Ghost\PostBundle\Security;

use Ghost\PostBundle\Entity\User;
use Ghost\PostBundle\Entity\Topic;
use Ghost\PostBundle\Entity\Post;

/**
 * @author Wenming Tang <tang@babyfamily.com>
 */
class Authorizer implements AuthorizerInterface
{
    /**
     * @var AuthenticatorInterface
     */
    private $authenticator;

    /**
     * @param AuthenticatorInterface $authenticator
     */
    public function __construct(AuthenticatorInterface $authenticator)
    {
        $this->authenticator = $authenticator;
    }

    /**
     * {@inheritDoc}
     */
    public function canEditTopic(Topic $topic)
    {
        return $this->getAuthenticatedUser()->equals($topic->getUser());
    }

    /**
     * {@inheritDoc}
     */
    public function canDeleteTopic(Topic $topic)
    {
        return $this->canEditTopic($topic);
    }

    /**
     * {@inheritDoc}
     */
    public function canEditPost(Post $post)
    {
        return $this->getAuthenticatedUser()->equals($post->getUser());
    }

    /**
     * {@inheritDoc}
     */
    public function canDeletePost(Post $post)
    {
        return $this->canEditPost($post);
    }

    /**
     * Gets the current authenticated user
     *
     * @return User
     */
    public function getAuthenticatedUser()
    {
        return $this->authenticator->getAuthenticatedUser();
    }
}
