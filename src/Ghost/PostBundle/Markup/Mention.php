<?php
namespace Ghost\PostBundle\Markup;

use Ghost\PostBundle\Markup\ParserInterface;

/**
 * @author Wenming Tang <tang@babyfamily.com>
 */
class Mention implements ParserInterface
{
    public function parse($input)
    {
        return preg_replace('/@([a-zA-Z0-9_]{1,20})/i', '<a href="/@\\1" title="@\\1"><i>@</i>\\1</a>', $input);
    }
}
