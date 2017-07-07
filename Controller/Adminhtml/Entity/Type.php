<?php

namespace Ainnomix\EntityTypeManager\Controller\Adminhtml\Entity;

use Ainnomix\EntityTypeManager\Api\Data\EntityTypeInterface;
use Ainnomix\EntityTypeManager\Api\EntityTypeManagementInterface;
use Magento\Backend\App\Action;

abstract class Type extends Action
{

    const ADMIN_RESOURCE = 'Ainnomix_EntityTypeManager::etm_entity_type_manage';

    protected $entityTypeManagement;

    public function __construct(Action\Context $context, EntityTypeManagementInterface $entityTypeManagement)
    {
        parent::__construct($context);

        $this->entityTypeManagement = $entityTypeManagement;
    }

    /**
     * @return bool|EntityTypeInterface
     */
    protected function initCurrentEntityType()
    {
        $entityTypeId = $this->getRequest()->getParam('entity_type_id');

        return $this->entityTypeManagement->get((int) $entityTypeId);
    }
}
