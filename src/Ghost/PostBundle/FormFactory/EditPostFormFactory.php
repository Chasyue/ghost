<?php
namespace Ghost\PostBundle\FormFactory;

use Ghost\PostBundle\Entity\Post;
use Symfony\Component\Form\Form;

/**
 * @author Wenming Tang <tang@babyfamily.com>
 */
class EditPostFormFactory extends AbstractFormFactory
{
    /**
     * Creates a form
     *
     * @param Post $post
     *
     * @return Form
     */
    public function createForm(Post $post)
    {
        $builder = $this->formFactory->createBuilder($this->type, $post);

        return $builder->getForm();
    }
}