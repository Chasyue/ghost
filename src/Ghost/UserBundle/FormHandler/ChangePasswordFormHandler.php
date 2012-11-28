<?php
namespace Ghost\UserBundle\FormHandler;

use Symfony\Component\Form\FormInterface;
use Ghost\UserBundle\Entity\User;
use Ghost\UserBundle\EntityManager\UserManager;
use Symfony\Component\HttpFoundation\Request;

/**
 * @author Wenming Tang <tang@babyfamily.com>
 */
class ChangePasswordFormHandler
{
    protected $request;

    protected $userManager;

    public function __construct(Request $request, UserManager $userManager)
    {
        $this->request     = $request;
        $this->userManager = $userManager;
    }

    public function process(FormInterface $form, User $user)
    {
        if ('POST' === $this->request->getMethod()) {
            $form->bind($this->request);

            if ($form->isValid()) {
                $user->setPlainPassword($form->getData()->getNew());
                $this->onSuccess($user);

                return true;
            }
        }

        return false;
    }

    protected function onSuccess(User $user)
    {
        $this->userManager->saveUser($user);
    }
}
