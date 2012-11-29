<?php
namespace Ghost\UserBundle\FormHandler;

use Symfony\Component\Form\FormInterface;
use Ghost\UserBundle\Model\UserInterface;
use Symfony\Component\HttpFoundation\Request;
use Ghost\UserBundle\EntityManager\UserManager;

/**
 * @author Wenming Tang <tang@babyfamily.com>
 */
class RegistrationFormHandler
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

    public function process()
    {
        $user = $this->createUser();
        $this->form->setData($user);

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
        $this->userManager->saveUser($user);
    }

    /**
     * @return UserInterface
     */
    protected function createUser()
    {
        return $this->userManager->createUser();
    }
}
