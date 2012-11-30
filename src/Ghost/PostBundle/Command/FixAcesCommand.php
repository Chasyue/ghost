<?php
namespace Ghost\PostBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Security\Acl\Domain\ObjectIdentity;
use Symfony\Component\Security\Acl\Exception\AclNotFoundException;

/**
 * @author Wenming Tang <tang@babyfamily.com>
 */
class FixAcesCommand extends ContainerAwareCommand
{
    /**
     * @see Command
     */
    protected function configure()
    {
        $this
            ->setName('ghost:acl:fixAces')
            ->setDescription('Fixes Object Ace entries')
            ->setHelp(<<<EOT
This command will fix all Ace entries for existing objects. This command only needs to
be run when there are Objects that do not have Ace entries.
EOT
        );
    }

    /**
     * @see Command
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if (!$this->getContainer()->has('security.acl.provider')) {
            $output->writeln('You must setup the ACL system, see the Symfony2 documentation for how to do this.');

            return;
        }

        $provider = $this->getContainer()->get('security.acl.provider');

        $topicAcl     = $this->getContainer()->get('ghost.acl.topic');
        $postAcl      = $this->getContainer()->get('ghost.acl.post');
        $topicManager = $this->getContainer()->get('ghost.manager.topic.default');
        $postManager  = $this->getContainer()->get('ghost.manager.post.default');


        $foundTopicAcls   = 0;
        $foundPostAcls    = 0;
        $createdTopicAcls = 0;
        $createdPostAcls  = 0;

        foreach ($topicManager->findAllTopics() as $topic) {
            $oid = new ObjectIdentity($topic->getId(), get_class($topic));

            try {
                $provider->findAcl($oid);
                $foundTopicAcls++;
            } catch (AclNotFoundException $e) {
                $topicAcl->setDefaultAcl($topic);
                $createdTopicAcls++;
            }
        }

        foreach ($postManager->findAllPosts() as $post) {
            $oid = new ObjectIdentity($post->getId(), get_class($post));

            try {
                $provider->findAcl($oid);
                $foundPostAcls++;
            } catch (AclNotFoundException $e) {
                $postAcl->setDefaultAcl($post);
                $createdPostAcls++;
            }
        }

        $output->writeln("Found {$foundTopicAcls} Topic Acl Entries, Created {$createdTopicAcls} Topic Acl Entries");
        $output->writeln("Found {$foundPostAcls} Post Acl Entries, Created {$createdPostAcls} Post Acl Entries");
    }
}
