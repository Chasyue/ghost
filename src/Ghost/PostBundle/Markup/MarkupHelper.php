<?php
namespace Ghost\PostBundle\Markup;

use Ghost\PostBundle\Markup\ParserInterface;

/**
 * @author Wenming Tang <tang@babyfamily.com>
 */
class MarkupHelper
{
    /**
     * @var ParserInterface[]
     */
    private $parsers = array();

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->parsers = array(
            new Markup(),
            new Mention()
        );
    }

    /**
     * Transforms markdown syntax to HTML
     *
     * @param string   $markdownText The markdown syntax text
     *
     * @return string  The HTML code
     */
    public function transform($markdownText)
    {
        foreach ($this->parsers as $parser) {
            $markdownText = $parser->parse($markdownText);
        }

        return $markdownText;
    }
}
