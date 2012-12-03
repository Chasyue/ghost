<?php
namespace Ghost\PostBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Category controller
 *
 * @author Wenming Tang <tang@babyfamily.com>
 */
class CategoryController extends Controller
{
    /**
     * Lists categories
     */
    public function sidebarAction()
    {
        $categories = $this->get('ghost.manager.category.default')->findAllCategories();

        return $this->render('GhostPostBundle:Category:sidebar.html.twig', array(
            'categories' => $categories,
        ));
    }
}
