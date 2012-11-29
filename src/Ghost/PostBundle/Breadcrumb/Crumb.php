<?php
namespace Ghost\PostBundle\Breadcrumb;

/**
 * @author Wenming Tang <tang@babyfamily.com>
 */
class Crumb
{
    protected $text;

    protected $url;

    public function __construct($text, $url = '')
    {
        $this->text = $text;
        $this->url  = $url;
    }

    public function getText()
    {
        return $this->text;
    }

    public function getUrl()
    {
        return $this->url;
    }
}
