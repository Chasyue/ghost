<?php
namespace Ghost\PostBundle\Twig\Extension;

use Ghost\PostBundle\Acl\TopicAclInterface;
use Ghost\PostBundle\Model\TopicInterface;

/**
 * @author Wenming Tang <tang@babyfamily.com>
 */
class TopicAclExtension extends \Twig_Extension
{
    /**
     * @var TopicAclInterface
     */
    protected $topicAcl;

    /**
     * @param TopicAclInterface $topicAcl
     */
    public function __construct(TopicAclInterface $topicAcl)
    {
        $this->topicAcl = $topicAcl;
    }

    /**
     * {@inheritDoc}
     */
    public function getFunctions()
    {
        return array(
            'can_create_topic' => new \Twig_Function_Method($this, 'canCreate'),
            'can_view_topic'   => new \Twig_Function_Method($this, 'canView'),
            'can_edit_topic'   => new \Twig_Function_Method($this, 'canEdit'),
            'can_delete_topic' => new \Twig_Function_Method($this, 'canDelete'),
            'can_reply_topic'  => new \Twig_Function_Method($this, 'canReply')
        );
    }

    /**
     * @return boolean
     */
    public function canCreate()
    {
        return $this->topicAcl->canCreate();
    }

    /**
     * @param TopicInterface $topic
     *
     * @return boolean
     */
    public function canView(TopicInterface $topic)
    {
        return $this->topicAcl->canView($topic);
    }

    /**
     * @param TopicInterface $topic
     *
     * @return boolean
     */
    public function canEdit(TopicInterface $topic)
    {
        return $this->topicAcl->canEdit($topic);
    }

    /**
     * @param TopicInterface $topic
     *
     * @return boolean
     */
    public function canDelete(TopicInterface $topic)
    {
        return $this->topicAcl->canDelete($topic);
    }

    /**
     * @param TopicInterface $topic
     *
     * @return boolean
     */
    public function canReply(TopicInterface $topic)
    {
        return $this->topicAcl->canReply($topic);
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'ghost.topic_acl';
    }
}
