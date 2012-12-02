<?php
namespace Ghost\PostBundle\Breadcrumb;

/**
 * @author Wenming Tang <tang@babyfamily.com>
 */
class Breadcrumb
{
    protected $breadcrumbs;

    public function  __construct()
    {
        $this->breadcrumbs = array();
        $this->add('Home', '/');
    }

    public function add($text, $url = '')
    {
        $this->breadcrumbs[] = new Crumb($text, $url);

        return $this;
    }

    public function getBreadcrumbs()
    {
        return $this->breadcrumbs;
    }
}
