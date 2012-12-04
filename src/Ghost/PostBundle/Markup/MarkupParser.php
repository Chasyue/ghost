<?php
namespace Ghost\PostBundle\Markup;

/**
 * @author Wenming Tang <tang@babyfamily.com>
 */
class MarkupParser implements ParserInterface
{
    private $no_entities = false;

    /**
     * {@inheritDoc}
     */
    public function parse($raw)
    {
        $raw = htmlspecialchars($raw, ENT_NOQUOTES);
        $raw = preg_replace_callback('{(http://[^\'"\s]+\.(png|jpg|gif))}i', array(&$this, 'ImgTagCallback'), $raw);
        $raw = preg_replace_callback('{(http://[^\'"\s]+)}i', array(&$this, 'autoLinksCallback'), $raw);
        $raw = nl2br($raw);

        return $raw;
    }

    private function ImgTagCallback($matches)
    {
        $src = $this->encodeAttribute($matches[1]);
        return "<img src=\"$src\" />";
    }

    private function autoLinksCallback($matches)
    {
        $url = $this->encodeAttribute($matches[1]);
        return "<a href=\"$url\">$url</a>";
    }

    private function encodeAttribute($text) {
        #
        # Encode text for a double-quoted HTML attribute. This function
        # is *not* suitable for attributes enclosed in single quotes.
        #
        $text = $this->encodeAmpsAndAngles($text);
        $text = str_replace('"', '&quot;', $text);
        return $text;
    }


    private function encodeAmpsAndAngles($text) {
        #
        # Smart processing for ampersands and angle brackets that need to
        # be encoded. Valid character entities are left alone unless the
        # no-entities mode is set.
        #
        if ($this->no_entities) {
            $text = str_replace('&', '&amp;', $text);
        } else {
            # Ampersand-encoding based entirely on Nat Irons's Amputator
            # MT plugin: <http://bumppo.net/projects/amputator/>
            $text = preg_replace('/&(?!#?[xX]?(?:[0-9a-fA-F]+|\w+);)/',
                '&amp;', $text);;
        }
        # Encode remaining <'s
        $text = str_replace('<', '&lt;', $text);

        return $text;
    }
}
