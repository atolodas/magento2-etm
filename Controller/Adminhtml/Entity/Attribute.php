<?php

namespace Ainnomix\EntityTypeManager\Controller\Adminhtml\Entity;

use Ainnomix\EntityTypeManager\Api\EntityAttributeManagerInterface;
use Ainnomix\EntityTypeManager\Api\EntityTypeManagerInterface;
use Ainnomix\EntityTypeManager\Helper\Data;
use Magento\Backend\App\Action;
use Magento\Framework\Exception\NotFoundException;
use Magento\Framework\Registry;
use Magento\Backend\Model\View\Result\ForwardFactory;

abstract class Attribute extends Base
{

    protected $aclSuffix = 'attributes';

    protected $requestIdFieldName = 'entity_type';

    /**
     * @var EntityAttributeManagerInterface
     */
    protected $attributeManager;

    protected $attribute;

    public function __construct(
        Action\Context $context,
        Registry $registry,
        EntityTypeManagerInterface $entityTypeManager,
        Data $entityTypeHelper,
        ForwardFactory $resultForwardFactory,
        EntityAttributeManagerInterface $attributeManager
    ) {
        parent::__construct($context, $registry, $entityTypeManager, $entityTypeHelper, $resultForwardFactory);

        $this->attributeManager = $attributeManager;
    }

    /**
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed($this->getEntityTypeMenuId());
    }

    public function getAttribute($requestFieldName = 'attribute_id')
    {
        if ($this->attribute) {
            return $this->attribute;
        }

        $attributeId = (int) $this->getRequest()->getParam($requestFieldName);
        $attribute = $this->attributeManager->get($attributeId, $this->getEntityType());

        if ($attributeId && !$attribute->getAttributeId()) {
            throw new NotFoundException(__('Requested entity attribute "%1" does not exist', $attributeId));
        }

        $this->registry->register('entity_attribute', $attribute);
        $this->attribute = $attribute;

        return $attribute;
    }
}
