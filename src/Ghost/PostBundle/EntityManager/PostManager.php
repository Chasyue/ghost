<?php
namespace Ghost\PostBundle\EntityManager;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Ghost\PostBundle\Entity\Post;

/**
 * @author Wenming Tang <tang@babyfamily.com>
 */
class PostManager
{
    /**
     * @var EntityManager
     */
    private $em;

    /**
     * @var EntityRepository
     */
    private $repository;

    /**
     * @var string
     */
    private $class;

    /**
     * @param EntityManager               $em
     * @param                             $class
     */
    public function __construct(EntityManager $em, $class)
    {
        $this->em         = $em;
        $this->repository = $em->getRepository($class);
        $this->class      = $em->getClassMetadata($class)->getName();
    }

    /**
     * @return Post
     */
    public function createPost()
    {
        $post = new $this->class;

        return $post;
    }

    /**
     * @param integer $id
     *
     * @return Post
     */
    public function findPost($id)
    {
        return $this->repository->find($id);
    }

    /**
     * @param Post $post
     */
    public function savePost(Post $post)
    {
        $this->em->persist($post);
        $this->em->flush();
    }

    /**
     * @param Post $post
     */
    public function deletePost(Post $post)
    {
        $post->setIsDeleted(true);
        $this->em->persist($post);
        $this->em->flush();
    }
}
