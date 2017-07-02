<?php

namespace Ainnomix\EntityTypeManager\Controller\Adminhtml\Entity;

use Ainnomix\EntityTypeManager\Api\Data\EntityTypeInterface;
use Ainnomix\EntityTypeManager\Api\EntityTypeRepositoryInterface;
use Magento\Backend\App\Action;

abstract class Type extends Action
{

    const ADMIN_RESOURCE = 'Ainnomix_EntityTypeManager::etm_entity_type_manage';

    protected $entityTypeRepository;

    public function __construct(Action\Context $context, EntityTypeRepositoryInterface $entityTypeRepository)
    {
        parent::__construct($context);

        $this->entityTypeRepository = $entityTypeRepository;
    }

    /**
     * @return bool|EntityTypeInterface
     */
    protected function initCurrentEntityType()
    {
        $entityTypeId = $this->getRequest()->getParam('entity_type_id');

        if (!$entityTypeId) {
            return false;
        }

        $entityType = $this->entityTypeRepository->getById($entityTypeId);

        return $entityType;
    }
}
