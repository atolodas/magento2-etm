<?php

namespace Ainnomix\EntityTypeManager\Controller\Adminhtml\Entity;

use Ainnomix\EntityTypeManager\Api\EntityAttributeManagerInterface;
use Ainnomix\EntityTypeManager\App\Backend\Action\Context;
use Ainnomix\EntityTypeManager\Controller\Adminhtml\Entity\Attribute\Builder;
use Ainnomix\EntityTypeManager\Helper\Backend\Data;
use Magento\Backend\App\Action as BackendAction;

abstract class Attribute extends Action
{

    /**
     * @var Data
     */
    protected $backendHelper;

    /**
     * @var Builder
     */
    protected $entityAttributeBuilder;

    /**
     * @var EntityAttributeManagerInterface
     */
    protected $entityAttributeManager;

    public function __construct(BackendAction\Context $context, Context $managerContext)
    {
        parent::__construct($context, $managerContext);

        $this->backendHelper = $managerContext->getBackendHelper();
        $this->entityAttributeBuilder = $managerContext->getEntityAttributeBuilder();
        $this->entityAttributeManager = $managerContext->getEntityAttributeManager();
    }

    public function getEntityTypeAclId()
    {
        return $this->backendHelper->getEntityTypeAclId(
            $this->entityTypeBuilder->build($this->getRequest(), 'entity_type_id'),
            'attributes'
        );
    }

    public function getEntityTypeMenuId()
    {
        return $this->getEntityTypeAclId();
    }

    /**
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed($this->getEntityTypeAclId());
    }
}
