<?php
namespace Ghost\UserBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;

/**
 * Registration Controller
 */
class RegistrationController extends Controller
{
    public function registerAction()
    {
        $form        = $this->get('ghost.form.registration');
        $formHandler = $this->get('ghost.form.handler.registration');

        if ($formHandler->process()) {
            return $this->redirect($this->generateUrl('home'));
        }

        return $this->render('GhostUserBundle:Registration:register.html.twig', array(
            'form' => $form->createView()
        ));
    }
}
