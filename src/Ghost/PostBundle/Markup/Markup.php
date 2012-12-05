<?php
namespace Ghost\PostBundle\Markup;

/**
 * @author Wenming Tang <tang@babyfamily.com>
 */
class Markup implements ParserInterface
{
    private $parser;

    public function getParser()
    {
        if (null == $this->parser) {
            $this->parser = new \Sundown\Markdown(new \Sundown\Render\HTML(array(
                'filter_html'     => true,
                'no_styles'       => true,
                'no_links'        => true,
                'no_images'       => true,
                'safe_links_only' => true,
                'with_toc_data'   => true,
                'hard_wrap'       => true,
                'xhtml'           => true,

            )), array(
                'autolink'            => true,
                'tables'              => false,
                'no_intra_emphasis'   => true,
                'fenced_code_blocks'  => true,
                'strikethrough'       => false,
                'space_after_headers' => true,
                'superscript'         => true,


            ));
        }

        return $this->parser;
    }

    public function parse($raw)
    {
        $text = $this->getParser()->render(' ' . $raw); // this is a bug

        return $text;
    }
}