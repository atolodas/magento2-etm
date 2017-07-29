<?php

namespace Ainnomix\EntityTypeManager\Controller\Adminhtml\Entity;

use Magento\Backend\App\Action as BackendAction;
use Ainnomix\EntityTypeManager\App\Backend\Action\Context;

abstract class Type extends Action
{

    const ADMIN_RESOURCE = 'Ainnomix_EntityTypeManager::manage_entity_types';

    /**
     * @var \Ainnomix\EntityTypeManager\Api\EntityTypeManagerInterface
     */
    protected $entityTypeManager;

    public function __construct(BackendAction\Context $context, Context $managerContext)
    {
        parent::__construct($context, $managerContext);

        $this->entityTypeManager = $managerContext->getEntityTypeManager();
    }
}
