<?php
namespace Ghost\PostBundle\Markup;

use Knp\Bundle\MarkdownBundle\Parser\MarkdownParser;

/**
 * @author Wenming Tang <tang@babyfamily.com>
 */
class Markup implements ParserInterface
{
    /**
     * @var MarkdownParser
     */
    private $parser;

    /**
     * @return MarkdownParser
     */
    private function getParser()
    {
        if (null == $this->parser) {
            $this->parser = new MarkdownParser(array(
                'no_html'  => true,
                'entities' => false,
                'header'   => false,
                'table'    => false
            ));
        }

        return $this->parser;
    }

    /**
     * Takes a markup string and returns raw html.
     *
     * @param  string $raw
     *
     * @return string
     */
    public function parse($raw)
    {
        return $this->getParser()->transformMarkdown($raw);
    }
}