<?php
namespace Ghost\PostBundle\FormFactory;

use Ghost\PostBundle\Entity\Topic;
use Symfony\Component\Form\Form;

/**
 * @author Wenming Tang <tang@babyfamily.com>
 */
class EditTopicFormFactory extends AbstractFormFactory
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
        $builder = $this->formFactory->createBuilder($this->type, $topic);

        return $builder->getForm();
    }
}