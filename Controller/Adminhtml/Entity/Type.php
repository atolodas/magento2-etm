<?php

namespace Ainnomix\EntityTypeManager\Controller\Adminhtml\Entity;

use Ainnomix\EntityTypeManager\Model\RegistryConstants;
use Magento\Backend\App\Action;

abstract class Type extends Action
{

    const ADMIN_RESOURCE = 'Ainnomix_EntityTypeManager::etm_entity_type_manage';

    protected $coreRegistry;

    public function __construct(
        Action\Context $context,
        \Magento\Framework\Registry $coreRegistry
    ) {
        $this->coreRegistry = $coreRegistry;

        parent::__construct($context);
    }

    protected function initCurrentEntityType()
    {
        $entityTypeId = $this->getRequest()->getParam('entity_type_id');

        if ($entityTypeId) {
            $this->coreRegistry->register(RegistryConstants::CURRENT_ENTITY_TYPE_ID, $entityTypeId);
        }

        return $entityTypeId;
    }
}
