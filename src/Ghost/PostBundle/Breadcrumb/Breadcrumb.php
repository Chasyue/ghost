<?php
namespace Ghost\PostBundle\Breadcrumb;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @author Wenming Tang <tang@babyfamily.com>
 */
class Breadcrumb
{
    protected $breadcrumbs;

    public function  __construct()
    {
        $this->breadcrumbs = new ArrayCollection();
        $this->add('home', '/');
    }

    public function add($text, $url = '')
    {
        $this->breadcrumbs->add(new Crumb($text, $url));

        return $this;
    }

    public function getBreadcrumbs()
    {
        return $this->breadcrumbs;
    }
}
