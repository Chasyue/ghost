<?php

namespace Ghost\UserBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Ghost\UserBundle\Entity\User;

/**
 * ChangePassword Controller
 */
class ChangePasswordController extends Controller
{
    public function editAction(Request $request)
    {
        $user = $this->getUser();

        if (!is_object($user) || !$user instanceof User) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        $form        = $this->get('ghost.form_factory.change_password')->createForm($user);
        $formHandler = $this->get('ghost.form_handler.change_password');

        if ($formHandler->process($form, $user)) {
            return $this->redirect($this->generateUrl('home'));
        }

        return $this->render('GhostUserBundle:ChangePassword:edit.html.twig', array(
            'form' => $form->createView()
        ));
    }
}
