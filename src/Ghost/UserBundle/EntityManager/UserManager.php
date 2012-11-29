<?php
namespace Ghost\UserBundle\EntityManager;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;
use Ghost\UserBundle\ModelManager\UserManager as BaseUserManager;
use Ghost\UserBundle\Model\UserInterface;

/**
 * User Manager
 *
 * @author Wenming Tang <tang@babyfamily.com>
 */
class UserManager extends BaseUserManager
{
    /**
     * @var EntityManager
     */
    protected $em;

    /**
     * @var \Doctrine\ORM\EntityRepository
     */
    protected $repository;

    /**
     * @var string
     */
    protected $class;

    /**
     * @var EncoderFactoryInterface
     */
    protected $encoderFactory;

    /**
     * @param EncoderFactoryInterface                                               $encoderFactory
     * @param EntityManager                                                         $em
     * @param string                                                                $class
     */
    function __construct(EncoderFactoryInterface $encoderFactory, EntityManager $em, $class)
    {
        $this->encoderFactory = $encoderFactory;
        $this->em             = $em;
        $this->repository     = $em->getRepository($class);
        $this->class          = $em->getClassMetadata($class)->getName();
    }

    /**
     * {@inheritDoc}
     */
    public function findUserBy(array $criteria)
    {
        return $this->repository->findOneBy($criteria);
    }

    /**
     * {@inheritDoc}
     */
    public function saveUser(UserInterface $user)
    {
        $this->updatePassword($user);

        $this->em->persist($user);
        $this->em->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function reloadUser(UserInterface $user)
    {
        $this->em->refresh($user);
    }

    /**
     * {@inheritDoc}
     */
    public function updatePassword(UserInterface $user)
    {
        if (0 !== strlen($password = $user->getPlainPassword())) {
            $encoder = $this->getEncoder($user);
            $user->setPassword($encoder->encodePassword($password, $user->getSalt()));
            $user->eraseCredentials();
        }
    }

    /**
     * {@inheritDoc}
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * @param UserInterface $user
     *
     * @return PasswordEncoderInterface
     */
    protected function getEncoder(UserInterface $user)
    {
        return $this->encoderFactory->getEncoder($user);
    }
}