<?php
namespace Ghost\UserBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;

/**
 * Security Controller
 */
class SecurityController extends Controller
{
    public function loginAction()
    {
        $this->get('ghost.breadcrumb')->add('Sign In');

        $request = $this->getRequest();
        $session = $request->getSession();

        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } else {
            if ($session->has(SecurityContext::AUTHENTICATION_ERROR)) {
                $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
                $session->remove(SecurityContext::AUTHENTICATION_ERROR);
            } else {
                $error = '';
            }
        }

        if ($error) {
            $this->get('session')->setFlash('error', $error->getMessage());
        }

        $lastUsername = $session->get(SecurityContext::LAST_USERNAME);
        $targetPath   = $request->headers->get('referer');

        return $this->render('GhostUserBundle:Security:login.html.twig', array('last_username' => $lastUsername, 'target_path' => $targetPath));
    }
}
