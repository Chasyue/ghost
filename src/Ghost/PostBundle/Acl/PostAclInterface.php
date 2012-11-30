<?php
namespace Ghost\PostBundle\Acl;

use Ghost\PostBundle\Model\PostInterface;

/**
 * @author Wenming Tang <tang@babyfamily.com>
 */
interface PostAclInterface
{
    /**
     * @return boolean
     */
    public function canCreate();

    /**
     * @param PostInterface $post
     *
     * @return boolean
     */
    public function canView(PostInterface $post);

    /**
     * @param PostInterface $post
     *
     * @return boolean
     */
    public function canEdit(PostInterface $post);

    /**
     * @param PostInterface $post
     *
     * @return boolean
     */
    public function canDelete(PostInterface $post);

    /**
     * @param PostInterface $post
     *
     * @return void
     */
    public function setDefaultAcl(PostInterface $post);

    /**
     * @return void
     */
    public function installFallbackAcl();

    /**
     * @return void
     */
    public function uninstallFallBackAcl();
}