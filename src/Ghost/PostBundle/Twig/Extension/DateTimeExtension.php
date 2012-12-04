<?php
namespace Ghost\PostBundle\Twig\Extension;

/**
 * @author Wenming Tang <tang@babyfamily.com>
 */
class DateTimeExtension extends \Twig_Extension
{
    /**
     * {@inheritDoc}
     */
    public function getFilters()
    {
        return array(
            'time_ago' => new \Twig_Filter_Method($this, 'ago')
        );
    }

    function ago($time)
    {
        $periods = array("s", "min", "h", "d", "w", "mon", "year", "decade");
        $lengths = array("60", "60", "24", "7", "4.35", "12", "10");

        $now = time();

        $difference = $now - $time;
        $tense      = "ago";

        if ($difference == 0) {
            return 'just now';
        }

        for ($j = 0; $difference >= $lengths[$j] && $j < count($lengths) - 1; $j++) {
            $difference /= $lengths[$j];
        }

        $difference = round($difference);

        return "{$difference}{$periods[$j]} " . $tense;
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'ghost.date_time';
    }
}