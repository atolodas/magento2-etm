<?php

namespace Ainnomix\EntityTypeManager\Controller\Adminhtml\Entity;

use Magento\Backend\App\Action;
use Magento\Framework\Exception\NotFoundException;
use Magento\Framework\Registry;
use Magento\Backend\Model\View\Result\ForwardFactory;
use Ainnomix\EntityTypeManager\Api\EntityTypeManagerInterface;
use Ainnomix\EntityTypeManager\Api\EntityTypeRepositoryInterface;

/**
 * Entity types base action class
 */
abstract class Type extends Action
{

    const ADMIN_RESOURCE = 'Ainnomix_EntityTypeManager::manage_entity_types';

    /**
     * @var ForwardFactory
     */
    protected $resultForwardFactory;

    /**
     * @var Registry
     */
    protected $registry;

    /**
     * @var EntityTypeManagerInterface
     */
    protected $entityTypeManager;

    /**
     * @var EntityTypeRepositoryInterface
     */
    protected $entityTypeRepository;

    /**
     * Class constructor
     *
     * @param Action\Context $context
     * @param ForwardFactory $resultForwardFactory
     * @param Registry $registry
     * @param EntityTypeManagerInterface $entityTypeManager
     * @param EntityTypeRepositoryInterface $entityTypeRepository
     */
    public function __construct(
        Action\Context $context,
        ForwardFactory $resultForwardFactory,
        Registry $registry,
        EntityTypeManagerInterface $entityTypeManager,
        EntityTypeRepositoryInterface $entityTypeRepository
    ) {
        parent::__construct($context);

        $this->resultForwardFactory = $resultForwardFactory;
        $this->registry = $registry;
        $this->entityTypeManager = $entityTypeManager;
        $this->entityTypeRepository = $entityTypeRepository;
    }

    /**
     * @return \Ainnomix\EntityTypeManager\Model\Entity\Type
     * @throws NotFoundException
     */
    protected function initEntityType()
    {
        $entityTypeId = (int) $this->getRequest()->getParam('id');
        $entityType = $this->entityTypeManager->get($entityTypeId);
        
        if ($entityTypeId && !$entityType->getEntityTypeId()) {
            throw new NotFoundException(__('Requested entity type "%1" does not exist', $entityTypeId));
        }

        $this->registry->register('current_entity_type', $entityType);

        return $entityType;
    }
}
