<?php
namespace Ghost\UserBundle\ModelManager;

/**
 * User Manager
 *
 * @author Wenming Tang <tang@babyfamily.com>
 */
abstract class UserManager implements UserManagerInterface
{
    /**
     * {@inheritDoc}
     */
    public function createUser()
    {
        $class = $this->getClass();
        $user  = new $class;

        return $user;
    }

    /**
     * {@inheritDoc}
     */
    public function findUserByUsername($username)
    {
        return $this->findUserBy(array('username' => $username));
    }

    /**
     * {@inheritDoc}
     */
    public function findUserByEmail($email)
    {
        return $this->findUserBy(array('email' => $email));
    }

    /**
     * {@inheritDoc}
     */
    public function findUserByName($name)
    {
        return $this->findUserBy(array('name' => $name));
    }

    /**
     * {@inheritDoc}
     */
    public function findUserByUsernameOrEmail($usernameOrEmail)
    {
        if (filter_var($usernameOrEmail, FILTER_VALIDATE_EMAIL)) {
            return $this->findUserByEmail($usernameOrEmail);
        }

        return $this->findUserByUsername($usernameOrEmail);
    }
}