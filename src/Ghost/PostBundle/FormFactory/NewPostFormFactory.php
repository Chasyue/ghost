<?php
namespace Ghost\PostBundle\FormFactory;

use Ghost\PostBundle\Entity\Topic;
use Symfony\Component\Form\Form;

/**
 * @author Wenming Tang <tang@babyfamily.com>
 */
class NewPostFormFactory extends AbstractFormFactory
{
    /**
     * Creates a form
     *
     * @param Topic $topic
     *
     * @return Form
     */
    public function createForm(Topic $topic)
    {
        $post = $this->createModelInstance();
        $post->setTopic($topic);

        $builder = $this->formFactory->createBuilder($this->type, $post);

        return $builder->getForm();
    }
}