<?php
namespace Ghost\PostBundle\Event;

/**
 * @author Wenming Tang <tang@babyfamily.com>
 */
class Events
{
    const TOPIC_PRE_PERSIST = 'topic.pre_persist';

    const TOPIC_PERSIST = 'topic.persist';

    const TOPIC_DELETE = 'topic.delete';

    const POST_PRE_PERSIST = 'post.pre_persist';

    const POST_PERSIST = 'post.persist';

    const POST_DELETE = 'post.delete';
}