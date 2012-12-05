<?php
namespace Ghost\PostBundle\Twig\Extension;
use Ghost\PostBundle\Markup\ParserInterface;

/**
 * @author Wenming Tang <tang@babyfamily.com>
 */
class MarkupExtension extends \Twig_Extension
{
    /**
     * @var ParserInterface
     */
    private $parser;

    /**
     * @param ParserInterface $parser
     */
    public function __construct(ParserInterface $parser)
    {
        $this->parser = $parser;
    }

    public function getFilters()
    {
        return array(
            'markup' => new \Twig_Filter_Method($this, 'markup', array('is_safe' => array('html'))),
        );
    }

    public function markup($text)
    {
        return $this->parser->parse($text);
    }

    public function getName()
    {
        return 'ghost.markup';
    }
}
