<?php
namespace Ghost\PostBundle\FormHandler;

use Symfony\Component\Form\FormInterface;
use Ghost\PostBundle\Model\PostInterface;
use Ghost\PostBundle\ModelManager\PostManagerInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * @author Wenming Tang <tang@babyfamily.com>
 */
class PostFormHandler
{
    protected $request;

    protected $postManager;

    public function __construct(Request $request, PostManagerInterface $postManager)
    {
        $this->request     = $request;
        $this->postManager = $postManager;
    }

    public function process(FormInterface $form)
    {
        if ('POST' == $this->request->getMethod()) {
            $form->bind($this->request);

            if ($form->isValid()) {
                return $this->onSuccess($form->getData());
            }
        }

        return false;
    }

    public function onSuccess(PostInterface $post)
    {
        $this->postManager->savePost($post);

        return $post;
    }
}
