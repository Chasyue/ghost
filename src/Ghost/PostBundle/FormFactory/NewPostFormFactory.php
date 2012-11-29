<?php
namespace Ghost\PostBundle\FormFactory;

use Ghost\UserBundle\Model\UserInterface;
use Ghost\PostBundle\Model\TopicInterface;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

/**
 * @author Wenming Tang <tang@babyfamily.com>
 */
class NewPostFormFactory
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
    public function __construct(FormFactoryInterface $formFactory, AbstractType $type, $modelClass, SecurityContextInterface $securityContext)
    {
        $this->formFactory     = $formFactory;
        $this->type            = $type;
        $this->modelClass      = $modelClass;
        $this->securityContext = $securityContext;
    }

    /**
     * Creates a form
     *
     * @param TopicInterface $topic
     *
     * @return Form
     */
    public function createForm(TopicInterface $topic)
    {
        $post = new $this->modelClass;
        $post->setTopic($topic);
        $post->setUser($this->getAuthenticatedUser());

        $builder = $this->formFactory->createBuilder($this->type, $post);

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