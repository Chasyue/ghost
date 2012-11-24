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
        $topics = $this->getManager()->findAllTopic();

        return $this->render('GhostPostBundle:Topic:index.html.twig', array(
            'topics' => $topics,
        ));
    }

    /**
     * Finds and displays a Topic.
     */
    public function showAction($id)
    {
        $topic = $this->getManager()->findTopic($id);

        if (!$topic) {
            throw $this->createNotFoundException('Unable to find Topic.');
        }

        $postForm = $this->get('ghost.form_factory.post_new')->createForm($topic);

        return $this->render('GhostPostBundle:Topic:show.html.twig', array(
            'topic'     => $topic,
            'post_form' => $postForm->createView()
        ));
    }

    /**
     * Creates a new Topic.
     *
     */
    public function newAction(Request $request, $categoryAlias)
    {
        $category = $this->get('ghost.manager.category')->findCategoryByAlias($categoryAlias);

        if (!$category) {
            throw $this->createNotFoundException();
        }

        $topicManager = $this->getManager();
        $form         = $this->get('ghost.form_factory.topic_new')->createForm($category);

        if ('POST' == $request->getMethod()) {
            $form->bind($request);

            if ($form->isValid()) {
                $topic = $form->getData();
                $topicManager->saveTopic($topic);

                return $this->redirect($this->generateUrl('topic_show', array('id' => $topic->getId())));
            }
        }

        return $this->render('GhostPostBundle:Topic:new.html.twig', array(
            'category' => $category,
            'form'     => $form->createView()
        ));
    }

    /**
     * Edit an existing Topic.
     */
    public function editAction(Request $request, $id)
    {
        $topicManager = $this->getManager();
        $topic        = $topicManager->findTopic($id);

        if (!$topic) {
            throw $this->createNotFoundException('Unable to find Topic.');
        }

        $editForm   = $this->get('ghost.form_factory.topic_edit')->createForm($topic);
        $deleteForm = $this->createDeleteForm($id);

        if ('POST' == $request->getMethod()) {
            $editForm->bind($request);

            if ($editForm->isValid()) {
                $topicManager->saveTopic($topic);

                return $this->redirect($this->generateUrl('topic_show', array('id' => $id)));
            }
        }

        return $this->render('GhostPostBundle:Topic:edit.html.twig', array(
            'topic'       => $topic,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView()
        ));
    }

    /**
     * Deletes a Topic.
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $topicManager = $this->getManager();
            $topic        = $topicManager->findTopic($id);

            if (!$topic) {
                throw $this->createNotFoundException('Unable to find Topic.');
            }

            $topicManager->deleteTopic($topic);
        }

        return $this->redirect($this->generateUrl('topic'));
    }

    /**
     * Creates a delete form.
     *
     * @param integer $id topic id
     *
     * @return \Symfony\Component\Form\Form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm();
    }

    /**
     *
     *
     * @return \Ghost\PostBundle\EntityManager\TopicManager
     */
    private function getManager()
    {
        return $this->get('ghost.manager.topic');
    }
}
