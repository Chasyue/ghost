<?php
namespace Ghost\UserBundle\EntityManager;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;
use Ghost\UserBundle\Entity\User;

/**
 * User Manager
 *
 * @author Wenming Tang <tang@babyfamily.com>
 */
class UserManager
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
     * @return string
     */
    public function createUser()
    {
        $user = new $this->class;

        return $user;
    }

    /**
     * @param array $criteria
     *
     * @return User
     */
    public function findUserBy(array $criteria)
    {
        return $this->repository->findOneBy($criteria);
    }

    /**
     * @param User $user
     */
    public function saveUser(User $user)
    {
        $this->updatePassword($user);

        $this->em->persist($user);
        $this->em->flush();
    }

    /**
     * @param UserInterface $user
     */
    public function reloadUser(UserInterface $user)
    {
        $this->em->refresh($user);
    }

    /**
     * @param string $username
     *
     * @return User
     */
    public function findUserByUsername($username)
    {
        return $this->findUserBy(array('username' => $username));
    }

    /**
     * @param string $email
     *
     * @return User
     */
    public function findUserByEmail($email)
    {
        return $this->findUserBy(array('email' => $email));
    }

    /**
     * @param string $usernameOrEmail
     *
     * @return User
     */
    public function findUserByUsernameOrEmail($usernameOrEmail)
    {
        if (filter_var($usernameOrEmail, FILTER_VALIDATE_EMAIL)) {
            return $this->findUserByEmail($usernameOrEmail);
        }

        return $this->findUserByUsername($usernameOrEmail);
    }

    /**
     * @param User $user
     */
    public function updatePassword(User $user)
    {
        if (0 !== strlen($password = $user->getPlainPassword())) {
            $encoder = $this->getEncoder($user);
            $user->setPassword($encoder->encodePassword($password, $user->getSalt()));
            $user->eraseCredentials();
        }
    }

    /**
     * @param User $user
     *
     * @return PasswordEncoderInterface
     */
    protected function getEncoder(User $user)
    {
        return $this->encoderFactory->getEncoder($user);
    }
}