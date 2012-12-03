<?php
namespace Ghost\PostBundle\Twig\Extension;

use Ghost\PostBundle\Model\PostInterface;
use Ghost\PostBundle\Acl\PostAclInterface;

/**
 * @author Wenming Tang <tang@babyfamily.com>
 */
class PostAclExtension extends \Twig_Extension
{
    /**
     * @var PostAclInterface
     */
    protected $postAcl;

    /**
     * @param PostAclInterface $postAcl
     */
    public function __construct(PostAclInterface $postAcl)
    {
        $this->postAcl = $postAcl;
    }

    /**
     * {@inheritDoc}
     */
    public function getFunctions()
    {
        return array(
            'can_create_post' => new \Twig_Function_Method($this, 'canCreate'),
            'can_view_post'   => new \Twig_Function_Method($this, 'canView'),
            'can_edit_post'   => new \Twig_Function_Method($this, 'canEdit'),
            'can_delete_post' => new \Twig_Function_Method($this, 'canDelete')
        );
    }

    /**
     * @return boolean
     */
    public function canCreate()
    {
        return $this->postAcl->canCreate();
    }

    /**
     * @param PostInterface $post
     *
     * @return boolean
     */
    public function canView(PostInterface $post)
    {
        return $this->postAcl->canView($post);
    }

    /**
     * @param PostInterface $post
     *
     * @return boolean
     */
    public function canEdit(PostInterface $post)
    {
        return $this->postAcl->canEdit($post);
    }

    /**
     * @param PostInterface $post
     *
     * @return boolean
     */
    public function canDelete(PostInterface $post)
    {
        return $this->postAcl->canDelete($post);
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'ghost.post_acl';
    }
}
