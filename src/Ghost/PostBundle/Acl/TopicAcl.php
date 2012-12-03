<?php
namespace Ghost\PostBundle\Acl;

use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\Security\Acl\Model\MutableAclInterface;
use Symfony\Component\Security\Acl\Domain\RoleSecurityIdentity;
use Symfony\Component\Security\Acl\Exception\AclAlreadyExistsException;
use Symfony\Component\Security\Acl\Permission\MaskBuilder;
use Symfony\Component\Security\Acl\Domain\UserSecurityIdentity;
use Symfony\Component\Security\Acl\Model\ObjectIdentityRetrievalStrategyInterface;
use Symfony\Component\Security\Acl\Model\MutableAclProviderInterface;
use Symfony\Component\Security\Acl\Domain\ObjectIdentity;
use Ghost\PostBundle\Model\TopicInterface;

/**
 * @author Wenming Tang <tang@babyfamily.com>
 */
class TopicAcl implements TopicAclInterface
{
    /**
     * @var ObjectIdentityRetrievalStrategyInterface
     */
    protected $objectRetrieval;

    /**
     * @var MutableAclProviderInterface
     */
    protected $aclProvider;

    /**
     * @var SecurityContextInterface
     */
    protected $securityContext;

    /**
     * @var string
     */
    protected $topicClass;

    /**
     * @var ObjectIdentity
     */
    protected $oid;

    /**
     * @param SecurityContextInterface                      $securityContext
     * @param ObjectIdentityRetrievalStrategyInterface      $objectRetrieval
     * @param MutableAclProviderInterface                   $aclProvider
     * @param string                                        $threadClass
     */
    public function __construct(
        SecurityContextInterface $securityContext,
        ObjectIdentityRetrievalStrategyInterface $objectRetrieval,
        MutableAclProviderInterface $aclProvider,
        $threadClass
    )
    {
        $this->objectRetrieval = $objectRetrieval;
        $this->aclProvider     = $aclProvider;
        $this->securityContext = $securityContext;
        $this->threadClass     = $threadClass;
        $this->oid             = new ObjectIdentity('class', $this->threadClass);
    }

    /**
     * {@inheritDoc}
     */
    public function canCreate()
    {
        return $this->securityContext->isGranted('CREATE', $this->oid);
    }

    /**
     * {@inheritDoc}
     */
    public function canView(TopicInterface $topic)
    {
        return $this->securityContext->isGranted('VIEW', $topic);
    }

    /**
     * {@inheritDoc}
     */
    public function canEdit(TopicInterface $topic)
    {
        return $this->securityContext->isGranted('EDIT', $topic) && (time() - $topic->getCreated() <= 1800);
    }

    /**
     * {@inheritDoc}
     */
    public function canDelete(TopicInterface $topic)
    {
        return $this->securityContext->isGranted('DELETE', $topic);
    }

    /**
     * {@inheritDoc}
     */
    public function canReply(TopicInterface $topic)
    {
        return $this->canView($topic) && $topic->isDeleted() == false;
    }

    /**
     * {@inheritDoc}
     */
    public function setDefaultAcl(TopicInterface $topic)
    {
        $objectIdentity   = $this->objectRetrieval->getObjectIdentity($topic);
        $acl              = $this->aclProvider->createAcl($objectIdentity);
        $securityIdentity = UserSecurityIdentity::fromAccount($topic->getUser());

        $mask = new MaskBuilder();
        $mask
            ->add('create')
            ->add('view')
            ->add('edit')
            ->add('delete');

        $acl->insertObjectAce($securityIdentity, $mask->get());

        $this->aclProvider->updateAcl($acl);
    }

    /**
     * {@inheritDoc}
     */
    public function installFallbackAcl()
    {
        try {
            $acl = $this->aclProvider->createAcl($this->oid);
        } catch (AclAlreadyExistsException $exists) {
            return;
        }

        $this->doInstallFallbackAcl($acl, new MaskBuilder());
        $this->aclProvider->updateAcl($acl);
    }

    protected function doInstallFallbackAcl(MutableAclInterface $acl, MaskBuilder $builder)
    {
        $builder
            ->add('iddqd');
        $acl->insertClassAce(new RoleSecurityIdentity('ROLE_SUPER_ADMIN'), $builder->get());

        $builder
            ->reset()
            ->add('view');
        $acl->insertClassAce(new RoleSecurityIdentity('IS_AUTHENTICATED_ANONYMOUSLY'), $builder->get());

        $builder
            ->reset()
            ->add('create')
            ->add('view');
        $acl->insertClassAce(new RoleSecurityIdentity('ROLE_USER'), $builder->get());
    }

    /**
     * {@inheritDoc}
     */
    public function uninstallFallBackAcl()
    {
        $this->aclProvider->deleteAcl($this->oid);
    }
}
