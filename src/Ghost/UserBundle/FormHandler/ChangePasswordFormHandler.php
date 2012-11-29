<?php
namespace Ghost\UserBundle\FormHandler;

use Symfony\Component\Form\FormInterface;
use Ghost\UserBundle\Model\UserInterface;
use Ghost\UserBundle\FormModel\ChangePassword;
use Ghost\UserBundle\EntityManager\UserManager;
use Symfony\Component\HttpFoundation\Request;

/**
 * @author Wenming Tang <tang@babyfamily.com>
 */
class ChangePasswordFormHandler
{
    protected $request;

    protected $userManager;

    protected $form;

    public function __construct(FormInterface $form, Request $request, UserManager $userManager)
    {
        $this->form        = $form;
        $this->request     = $request;
        $this->userManager = $userManager;
    }

    public function process(UserInterface $user)
    {
        $this->form->setData(new ChangePassword());

        if ('POST' === $this->request->getMethod()) {
            $this->form->bind($this->request);

            if ($this->form->isValid()) {
                $this->onSuccess($user);

                return true;
            }
        }

        return false;
    }

    protected function onSuccess(UserInterface $user)
    {
        $user->setPlainPassword($this->getNewPassword());
        $this->userManager->saveUser($user);
    }

    public function getNewPassword()
    {
        return $this->form->getData()->getNew();
    }
}
