<?php
namespace Ghost\PostBundle\Markup;

/**
 * @author Wenming Tang <tang@babyfamily.com>
 */
interface ParserInterface
{
    /**
     * Takes a markup string and returns raw html.
     *
     * @param  string $raw
     * @return string
     */
    public function parse($raw);
}
