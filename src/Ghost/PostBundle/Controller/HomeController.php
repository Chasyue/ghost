<?php
namespace Ghost\PostBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Home controller
 *
 * @author Wenming Tang <tang@babyfamily.com>
 */
class HomeController extends Controller
{
    /**
     * Lists all Topic
     */
    public function indexAction()
    {
        $pager = $this->get('ghost.manager.topic.acl')->findTopics($this->getRequest()->get('page', 1));

        return $this->render('GhostPostBundle:Home:index.html.twig', array(
            'pager' => $pager,
        ));
    }
}
