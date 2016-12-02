<?php

namespace Ainnomix\EntityTypeManager\Controller\Adminhtml\Entity;

use Ainnomix\EntityTypeManager\Api\Data\EntityTypeInterface;
use Magento\Backend\App\Action;
use Magento\Framework\Registry;
use Ainnomix\EntityTypeManager\Helper\Data;
use Ainnomix\EntityTypeManager\Api\EntityTypeManagerInterface;
use Magento\Framework\Exception\NotFoundException;
use Magento\Backend\Model\View\Result\ForwardFactory;

abstract class Base extends Action
{

    protected $aclSuffix = 'base';

    protected $requestIdFieldName = 'id';

    /**
     * @var Registry
     */
    protected $registry;

    /**
     * @var EntityTypeManagerInterface
     */
    protected $entityTypeManager;

    /**
     * @var Data
     */
    protected $entityTypeHelper;

    /**
     * @var ForwardFactory
     */
    protected $resultForwardFactory;

    /**
     * @var EntityTypeInterface
     */
    protected $entityType;

    public function __construct(
        Action\Context $context,
        Registry $registry,
        EntityTypeManagerInterface $entityTypeManager,
        Data $entityTypeHelper,
        ForwardFactory $resultForwardFactory
    ) {
        parent::__construct($context);

        $this->registry = $registry;
        $this->entityTypeManager = $entityTypeManager;
        $this->entityTypeHelper = $entityTypeHelper;
        $this->resultForwardFactory = $resultForwardFactory;
    }

    /**
     *
     * @return \Ainnomix\EntityTypeManager\Model\Entity\Type
     *
     * @throws NotFoundException
     */
    protected function getEntityType()
    {
        if ($this->entityType) {
            return $this->entityType;
        }

        $entityTypeId = (int) $this->getRequest()->getParam($this->requestIdFieldName);
        $entityType = $this->entityTypeManager->get($entityTypeId);

        if ($entityTypeId && !$entityType->getEntityTypeId()) {
            throw new NotFoundException(__('Requested entity type "%1" does not exist', $entityTypeId));
        }

        $this->registry->register('current_entity_type', $entityType, true);
        $this->entityType = $entityType;

        return $entityType;
    }

    protected function getEntityTypeMenuId()
    {
        $entityType = $this->getEntityType();

        return $this->entityTypeHelper->getEntityTypeMenuId($entityType, $this->aclSuffix);
    }
}
