<?php
namespace Ghost\PostBundle\Acl;

use Ghost\PostBundle\Model\TopicInterface;

/**
 * @author Wenming Tang <tang@babyfamily.com>
 */
interface TopicAclInterface
{
    /**
     * @return boolean
     */
    public function canCreate();

    /**
     * @param TopicInterface $topic
     *
     * @return boolean
     */
    public function canView(TopicInterface $topic);

    /**
     * @param TopicInterface $topic
     *
     * @return boolean
     */
    public function canEdit(TopicInterface $topic);

    /**
     * @param TopicInterface $topic
     *
     * @return boolean
     */
    public function canDelete(TopicInterface $topic);

    /**
     * @param TopicInterface $topic
     *
     * @return void
     */
    public function setDefaultAcl(TopicInterface $topic);

    /**
     * @return void
     */
    public function installFallbackAcl();

    /**
     * @return void
     */
    public function uninstallFallBackAcl();
}