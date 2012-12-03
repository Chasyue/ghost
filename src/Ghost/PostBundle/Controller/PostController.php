<?php
namespace Ghost\PostBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Post controller
 *
 * @author Wenming Tang <tang@babyfamily.com>
 */
class PostController extends Controller
{
    /**
     * Creates a new Post
     */
    public function newAction($topicId)
    {
        $topic = $this->get('ghost.manager.topic.acl')->findTopic($topicId);

        if (!$topic) {
            throw $this->createNotFoundException();
        }

        $this->get('ghost.breadcrumb')
            ->add($topic->getCategory()->getName(), $this->generateUrl('topic_by_category', array('categoryAlias' => $topic->getCategory()->getAlias())))
            ->add($topic->getTitle(), $this->generateUrl('topic_show', array('id' => $topic->getId())))
            ->add('Reply to this topic');

        $form        = $this->get('ghost.form.factory.post_new')->createForm($topic);
        $formHandler = $this->get('ghost.form.handler.post');

        if ($formHandler->process($form)) {
            return $this->redirect($this->generateUrl('topic_show', array('id' => $topic->getId())) . '#reply' . $topic->getRepliesCount());
        }

        return $this->render('GhostPostBundle:Post:new.html.twig', array(
            'topic' => $topic,
            'form'  => $form->createView()
        ));
    }

    /**
     * Edit an existing Post
     */
    public function editAction($id)
    {
        $post = $this->get('ghost.manager.post.acl')->findPost($id);

        if (!$post) {
            throw $this->createNotFoundException('Unable to find Post.');
        }

        $this->get('ghost.breadcrumb')
            ->add($post->getTopic()->getCategory()->getName(), $this->generateUrl('topic_by_category', array('categoryAlias' => $post->getTopic()->getCategory()->getAlias())))
            ->add($post->getTopic()->getTitle(), $this->generateUrl('topic_show', array('id' => $post->getTopic()->getId())))
            ->add('Edit the reply');

        if (!$this->get('ghost.acl.post')->canEdit($post)) {
            throw new AccessDeniedException();
        }

        $form        = $this->get('ghost.form.factory.post_edit')->createForm($post);
        $formHandler = $this->get('ghost.form.handler.post');

        if ($formHandler->process($form)) {
            return $this->redirect($this->generateUrl('topic_show', array('id' => $post->getTopic()->getId())));
        }

        return $this->render('GhostPostBundle:Post:edit.html.twig', array(
            'post' => $post,
            'form' => $form->createView()
        ));
    }
}
