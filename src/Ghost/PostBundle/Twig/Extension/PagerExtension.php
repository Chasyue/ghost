<?php
namespace Ghost\PostBundle\Twig\Extension;

use Symfony\Component\Routing\RouterInterface;
use Ghost\PostBundle\Pagination\Pager;

/**
 * @author Wenming Tang <tang@babyfamily.com>
 */
class PagerExtension extends \Twig_Extension
{
    /**
     * @var RouterInterface
     */
    protected $router;

    /**
     * @var \Twig_Environment
     */
    protected $environment;

    /**
     * @param RouterInterface $router
     */
    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    /**
     * {@inheritDoc}
     */
    public function initRuntime(\Twig_Environment $environment)
    {
        $this->environment = $environment;
    }

    /**
     * {@inheritDoc}
     */
    public function getFunctions()
    {
        return array(
            'paginate'      => new \Twig_Function_Method($this, 'paginate', array('is_safe' => array('html'))),
            'paginate_path' => new \Twig_Function_Method($this, 'paginate_path', array('is_safe' => array('html'))),
        );
    }

    /**
     * @param Pager        $pager
     * @param string       $route
     * @param array        $parameters
     *
     * @return string
     */
    public function paginate(Pager $pager, $route, array $parameters = array())
    {
        return $this->environment->render('GhostPostBundle:Pager:pagination.html.twig', array(
            'pager'      => $pager,
            'route'      => $route,
            'parameters' => $parameters
        ));
    }

    /**
     * @param string       $route
     * @param integer      $page
     * @param array        $parameters
     *
     * @return string
     */
    public function paginate_path($route, $page, array $parameters = array())
    {
        if (isset($parameters['_page'])) {
            $parameters[$parameters['_page']] = $page;

            unset($parameters['_page']);
        } else {
            $parameters['page'] = $page;
        }

        return $this->router->generate($route, $parameters);
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'ghost.pager';
    }
}
