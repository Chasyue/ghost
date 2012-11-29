<?php
namespace Ghost\UserBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Ghost\UserBundle\Model\UserInterface;

/**
 * Profile Controller
 */
class ProfileController extends Controller
{
    public function editAction()
    {
        $user = $this->getUser();

        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        $form        = $this->get('ghost.form.profile');
        $formHandler = $this->get('ghost.form.handler.profile');

        if ($formHandler->process($user)) {
            return $this->redirect($this->generateUrl('home'));
        }

        return $this->render('GhostUserBundle:Profile:edit.html.twig', array(
            'form' => $form->createView()
        ));
    }
}
