<?php
namespace Ghost\PostBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Security\Acl\Domain\ObjectIdentity;

/**
 * @author Wenming Tang <tang@babyfamily.com>
 */
class MarkupCommand extends ContainerAwareCommand
{
    /**
     * @see Command
     */
    protected function configure()
    {
        $this
            ->setName('ghost:re-markup')->setDescription('Re-markup all Topic and Post entries');
    }

    /**
     * @see Command
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $topicManager = $this->getContainer()->get('ghost.manager.topic.default');
        $postManager  = $this->getContainer()->get('ghost.manager.post.default');
        $markupHelper = $this->getContainer()->get('ghost.helper.markup');

        $topicCount = 0;
        $postCount  = 0;

        foreach ($topicManager->findAllTopics() as $topic) {
            $result = $markupHelper->transform($topic->getBody());
            $topic->setRawBody($result);
            $topicManager->doSaveTopic($topic);

            $topicCount++;
        }

        foreach ($postManager->findAllPosts() as $post) {
            $result = $markupHelper->transform($post->getBody());
            $post->setRawBody($result);
            $postManager->doSavePost($post);

            $postCount++;
        }

        $output->writeln("Remarkup {$topicCount} Topic Entries");
        $output->writeln("Remarkup {$postCount} Post Entries");
    }
}