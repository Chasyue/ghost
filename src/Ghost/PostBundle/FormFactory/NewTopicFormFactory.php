<?php
namespace Ghost\PostBundle\FormFactory;

use Ghost\PostBundle\Model\CategoryInterface;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Ghost\UserBundle\Model\UserInterface;

/**
 * @author Wenming Tang <tang@babyfamily.com>
 */
class NewTopicFormFactory
{
    /**
     * @var FormFactoryInterface
     */
    protected $formFactory;

    /**
     * @var AbstractType
     */
    protected $type;

    /**
     * @var string
     */
    protected $modelClass;

    /**
     * @var SecurityContextInterface
     */
    protected $securityContext;

    /**
     * @param FormFactoryInterface                         $formFactory
     * @param AbstractType                                 $type
     * @param string                                       $modelClass
     * @param SecurityContextInterface                     $securityContext
     */
    public function __construct(FormFactoryInterface $formFactory, AbstractType $type, $modelClass = null, SecurityContextInterface $securityContext)
    {
        $this->formFactory     = $formFactory;
        $this->type            = $type;
        $this->modelClass      = $modelClass;
        $this->securityContext = $securityContext;
    }

    /**
     * Creates a form
     *
     * @param CategoryInterface $category
     *
     * @return Form
     */
    public function createForm(CategoryInterface $category)
    {
        $topic = new $this->modelClass;
        $topic->setCategory($category);
        $topic->setUser($this->getAuthenticatedUser());

        $builder = $this->formFactory->createBuilder($this->type, $topic);

        return $builder->getForm();
    }

    /**
     * @return UserInterface
     * @throws AccessDeniedException
     */
    public function getAuthenticatedUser()
    {
        $user = $this->securityContext->getToken()->getUser();

        if (!$user instanceof UserInterface) {
            throw new AccessDeniedException('Must be logged in with a User instance');
        }

        return $user;
    }
}