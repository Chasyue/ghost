<?php
namespace Ghost\UserBundle\FormHandler;

use Symfony\Component\Form\FormInterface;
use Ghost\UserBundle\Entity\User;
use Ghost\UserBundle\EntityManager\UserManager;
use Symfony\Component\HttpFoundation\Request;

/**
 * @author Wenming Tang <tang@babyfamily.com>
 */
class ProfileFormHandler
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

    public function process(User $user)
    {
        $this->form->setData($user);

        if ('POST' === $this->request->getMethod()) {
            $this->form->bind($this->request);

            if ($this->form->isValid()) {
                $this->onSuccess($user);

                return true;
            }

            $this->userManager->reloadUser($user);
        }

        return false;
    }

    protected function onSuccess(User $user)
    {
        $this->userManager->saveUser($user);
    }
}
