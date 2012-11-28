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
    public function registerAction(Request $request)
    {
        $form        = $this->get('ghost.form_factory.registration')->createForm();
        $formHandler = $this->get('ghost.form_handler.registration');

        if ($formHandler->process($form)) {
            return $this->redirect($this->generateUrl('home'));
        }

        return $this->render('GhostUserBundle:Registration:register.html.twig', array(
            'form' => $form->createView()
        ));
    }
}
