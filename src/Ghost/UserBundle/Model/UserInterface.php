<?php
namespace Ghost\UserBundle\Model;

use Symfony\Component\Security\Core\User\UserInterface as BaseUserInterface;

/**
 * User Interface
 *
 * @author Wenming Tang <tang@babyfamily.com>
 */
interface UserInterface extends BaseUserInterface
{
    /**
     * Get id
     *
     * @return integer
     */
    public function getId();

    /**
     * Set username
     *
     * @param string $username
     *
     * @return User
     */
    public function setUsername($username);

    /**
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password);

    /**
     * Set plain password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPlainPassword($password);

    /**
     * Get plain password
     *
     * @return string
     */
    public function getPlainPassword();

    /**
     * Set name
     *
     * @param string $name
     *
     * @return User
     */
    public function setName($name);

    /**
     * Get name
     *
     * @return string
     */
    public function getName();

    /**
     * Set email
     *
     * @param string $email
     *
     * @return User
     */
    public function setEmail($email);

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail();

    /**
     * Get created
     *
     * @return integer
     */
    public function getCreated();
}
