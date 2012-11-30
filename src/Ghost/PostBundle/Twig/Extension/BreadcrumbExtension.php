<?php
namespace Ghost\PostBundle\Twig\Extension;

use Ghost\PostBundle\Breadcrumb\Breadcrumb;
use Symfony\Component\DependencyInjection\Container;

/**
 * @author Wenming Tang <tang@babyfamily.com>
 */
class BreadcrumbExtension extends \Twig_Extension
{
    /**
     * @var Container
     */
    protected $container;

    /**
     * @var Breadcrumb
     */
    protected $breadcrumb;

    /**
     * @param Container  $container
     * @param Breadcrumb $breadcrumb
     */
    public function __construct(Container $container, Breadcrumb $breadcrumb)
    {
        $this->container  = $container;
        $this->breadcrumb = $breadcrumb;
    }

    /**
     * @return array
     */
    public function getFunctions()
    {
        return array(
            'breadcrumbs'        => new \Twig_Function_Method($this, 'breadcrumbs', array("is_safe" => array("html"))),
            'render_breadcrumbs' => new \Twig_Function_Method($this, 'renderBreadcrumbs', array("is_safe" => array("html")))
        );
    }

    /**
     * @return array
     */
    public function breadcrumbs()
    {
        return $this->breadcrumb->getBreadcrumbs();
    }

    /**
     * @return string
     */
    public function renderBreadcrumbs()
    {
        return $this->container->get('templating')->render('GhostPostBundle:Breadcrumb:breadcrumb.html.twig', array(
            'breadcrumbs' => $this->breadcrumbs()
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'ghost.breadcrumb';
    }
}
