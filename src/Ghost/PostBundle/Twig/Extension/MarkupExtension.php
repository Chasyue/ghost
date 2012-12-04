<?php
namespace Ghost\PostBundle\Twig\Extension;
use Ghost\PostBundle\Markup\MarkupParser;

/**
 * @author Wenming Tang <tang@babyfamily.com>
 */
class MarkupExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            'markup' => new \Twig_Filter_Method($this, 'markup', array('is_safe' => array('html'))),
        );
    }

    public function markup($text)
    {
        $parser = new MarkupParser();
        return $parser->parse($text);
    }

    public function getName()
    {
        return 'ghost.markup';
    }
}
