<?php
namespace Ghost\UserBundle\FormModel;

/**
 * @author Wenming Tang <tang@babyfamily.com>
 */
class ChangePassword
{
    /**
     * @var string
     */
    public $new;

    /**
     * @param string $password
     */
    public function setNew($password)
    {
        $this->new = $password;
    }

    /**
     * @return string
     */
    public function getNew()
    {
        return $this->new;
    }
}