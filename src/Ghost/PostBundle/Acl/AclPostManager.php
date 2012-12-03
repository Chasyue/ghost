<?php
namespace Ghost\PostBundle\Acl;

use Ghost\PostBundle\ModelManager\PostManagerInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Ghost\PostBundle\Model\PostInterface;
use Ghost\PostBundle\Model\TopicInterface;

/**
 * @author Wenming Tang <tang@babyfamily.com>
 */
class AclPostManager implements PostManagerInterface
{
    /**
     * @var PostManagerInterface
     */
    protected $realManager;

    /**
     * @var PostAclInterface
     */
    protected $postAcl;

    /**
     * @param PostManagerInterface $realManager
     * @param PostAclInterface     $acl
     */
    public function __construct(PostManagerInterface $realManager, PostAclInterface $acl)
    {
        $this->realManager = $realManager;
        $this->postAcl     = $acl;
    }

    /**
     * {@inheritDoc}
     */
    public function createPost()
    {
        return $this->realManager->createPost();
    }

    /**
     * {@inheritDoc}
     */
    public function findAllPosts()
    {
        $posts = $this->realManager->findAllPosts();

        foreach ($posts as $post) {
            if (!$this->postAcl->canView($post)) {
                throw new AccessDeniedException();
            }
        }

        return $posts;
    }

    /**
     * {@inheritDoc}
     */
    public function findPost($id)
    {
        $post = $this->realManager->findPost($id);

        if (null != $post && !$this->postAcl->canView($post)) {
            throw new AccessDeniedException();
        }

        return $post;
    }

    /**
     * {@inheritDoc}
     */
    public function findPostsByTopic(TopicInterface $topic)
    {
        $posts = $this->realManager->findPostsByTopic($topic);

        foreach ($posts as $post) {
            if (!$this->postAcl->canView($post)) {
                throw new AccessDeniedException();
            }
        }

        return $posts;
    }

    /**
     * {@inheritDoc}
     */
    public function savePost(PostInterface $post)
    {
        if (!$this->postAcl->canCreate()) {
            throw new AccessDeniedException();
        }

        $newPost = $this->isNewPost($post);

        if (!$newPost && !$this->postAcl->canEdit($post)) {
            throw new AccessDeniedException();
        }

        $this->realManager->savePost($post);

        if ($newPost) {
            $this->postAcl->setDefaultAcl($post);
        }
    }

    /**
     * {@inheritDoc}
     */
    public function deletePost(PostInterface $post)
    {
        if (!$this->postAcl->canDelete($post)) {
            throw new AccessDeniedException();
        }

        $this->realManager->deletePost($post);
    }

    /**
     * {@inheritDoc}
     */
    public function isNewPost(PostInterface $post)
    {
        return $this->realManager->isNewPost($post);
    }

    /**
     * {@inheritDoc}
     */
    public function getClass()
    {
        return $this->realManager->getClass();
    }
}
