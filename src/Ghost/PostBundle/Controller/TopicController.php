<?php
namespace Ghost\PostBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Topic controller.
 *
 * @author Wenming Tang <tang@babyfamily.com>
 */
class TopicController extends Controller
{
    /**
     * Lists all Topic.
     */
    public function indexAction()
    {
        $topics = $this->get('ghost.manager.topic')->findAllTopic();

        return $this->render('GhostPostBundle:Topic:index.html.twig', array(
            'topics' => $topics,
        ));
    }

    /**
     * Finds and displays a Topic.
     */
    public function showAction($id)
    {
        $this->get('ghost.breadcrumb')->add('category')->add('topic');

        $topic = $this->get('ghost.manager.topic')->findTopic($id);

        if (!$topic) {
            throw $this->createNotFoundException('Unable to find Topic.');
        }
        $this->get('ghost.manager.topic')->incrementViewsCount($topic);

        $postForm = $this->get('ghost.form.factory.post_new')->createForm($topic);

        return $this->render('GhostPostBundle:Topic:show.html.twig', array(
            'topic'     => $topic,
            'post_form' => $postForm->createView()
        ));
    }

    /**
     * Creates a new Topic.
     */
    public function newAction($categoryAlias)
    {
        $category = $this->get('ghost.manager.category')->findCategoryByAlias($categoryAlias);

        if (!$category) {
            throw $this->createNotFoundException();
        }

        $form        = $this->get('ghost.form.factory.topic_new')->createForm($category);
        $formHandler = $this->get('ghost.form.handler.topic');

        if ($topic = $formHandler->process($form)) {
            return $this->redirect($this->generateUrl('topic_show', array('id' => $topic->getId())));
        }

        return $this->render('GhostPostBundle:Topic:new.html.twig', array(
            'category' => $category,
            'form'     => $form->createView()
        ));
    }

    /**
     * Edit an existing Topic.
     */
    public function editAction($id)
    {
        $topic = $this->get('ghost.manager.topic')->findTopic($id);

        if (!$topic) {
            throw $this->createNotFoundException('Unable to find Topic.');
        }

        $form        = $this->get('ghost.form.factory.topic_edit')->createForm($topic);
        $formHandler = $this->get('ghost.form.handler.topic');

        if ($formHandler->process($form)) {
            return $this->redirect($this->generateUrl('topic_show', array('id' => $topic->getId())));
        }

        return $this->render('GhostPostBundle:Topic:edit.html.twig', array(
            'topic' => $topic,
            'form'  => $form->createView()
        ));
    }
}
