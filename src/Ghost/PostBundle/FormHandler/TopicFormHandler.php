<?php
namespace Ghost\PostBundle\FormHandler;

use Symfony\Component\Form\FormInterface;
use Ghost\PostBundle\Model\TopicInterface;
use Ghost\PostBundle\ModelManager\TopicManagerInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * @author Wenming Tang <tang@babyfamily.com>
 */
class TopicFormHandler
{
    protected $request;

    protected $topicManager;

    public function __construct(Request $request, TopicManagerInterface $topicManager)
    {
        $this->request      = $request;
        $this->topicManager = $topicManager;
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

    public function onSuccess(TopicInterface $topic)
    {
        $this->topicManager->saveTopic($topic);

        return $topic;
    }
}
