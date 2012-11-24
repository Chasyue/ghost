<?php
namespace Ghost\PostBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Post controller.
 *
 * @author Wenming Tang <tang@babyfamily.com>
 */
class PostController extends Controller
{
    /**
     * Creates a new Post.
     */
    public function newAction(Request $request, $topicId)
    {
        $topic = $this->get('ghost.manager.topic')->findTopic($topicId);

        if (!$topic) {
            throw $this->createNotFoundException();
        }

        $postManager = $this->getManager();
        $form        = $this->get('ghost.form_factory.post_new')->createForm($topic);

        if ('POST' == $request->getMethod()) {
            $form->bind($request);

            if ($form->isValid()) {
                $postManager->savePost($form->getData());

                return $this->redirect($this->generateUrl('topic_show', array('id' => $topic->getId())));
            }
        }

        return $this->render('GhostPostBundle:Post:new.html.twig', array(
            'topic' => $topic,
            'form'  => $form->createView()
        ));
    }

    /**
     * Edit an existing Post.
     */
    public function editAction(Request $request, $id)
    {
        $postManager = $this->getManager();
        $post        = $postManager->findPost($id);

        if (!$post) {
            throw $this->createNotFoundException('Unable to find Post.');
        }

        $editForm   = $this->get('ghost.form_factory.post_edit')->createForm($post);
        $deleteForm = $this->createDeleteForm($id);

        if ('POST' == $request->getMethod()) {
            $editForm->bind($request);

            if ($editForm->isValid()) {
                $postManager->savePost($post);

                return $this->redirect($this->generateUrl('topic_show', array('id' => $post->getTopic()->getId())));
            }
        }

        return $this->render('GhostPostBundle:Post:edit.html.twig', array(
            'post'        => $post,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Post.
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {

            $postManager = $this->getManager();
            $post        = $postManager->findPost($id);

            if (!$post) {
                throw $this->createNotFoundException('Unable to find Post.');
            }

            $postManager->deletePost($post);
        }

        return $this->redirect($this->generateUrl('post'));
    }

    /**
     * @return \Ghost\PostBundle\EntityManager\PostManager
     */
    private function getManager()
    {
        return $this->get('ghost.manager.post');
    }

    /**
     * Creates a delete form
     *
     * @param integer $id
     *
     * @return \Symfony\Component\Form\Form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm();
    }
}
