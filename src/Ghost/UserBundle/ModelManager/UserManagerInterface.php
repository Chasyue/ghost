<?php
namespace Ghost\UserBundle\ModelManager;

use Ghost\UserBundle\Model\UserInterface;

/**
 * UserManager Interface
 *
 * @author Wenming Tang <tang@babyfamily.com>
 */
interface UserManagerInterface
{
    /**
     * @return UserInterface
     */
    public function createUser();

    /**
     * @param array $criteria
     *
     * @return UserInterface
     */
    public function findUserBy(array $criteria);

    /**
     * @param UserInterface $user
     */
    public function saveUser(UserInterface $user);

    /**
     * @param UserInterface $user
     */
    public function reloadUser(UserInterface $user);

    /**
     * @param string $username
     *
     * @return UserInterface
     */
    public function findUserByUsername($username);

    /**
     * @param string $email
     *
     * @return UserInterface
     */
    public function findUserByEmail($email);

    /**
     * @param string $usernameOrEmail
     *
     * @return UserInterface
     */
    public function findUserByUsernameOrEmail($usernameOrEmail);

    /**
     * @param string $name
     *
     * @return UserInterface
     */
    public function findUserByName($name);

    /**
     * @param UserInterface $user
     */
    public function updatePassword(UserInterface $user);

    /**
     * @return string
     */
    public function getClass();
}