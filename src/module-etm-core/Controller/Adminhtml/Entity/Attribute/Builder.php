<?php

namespace Ainnomix\EntityTypeManager\Controller\Adminhtml\Entity\Attribute;

use Magento\Eav\Model\Entity\Attribute;
use Magento\Framework\App\RequestInterface;
use Ainnomix\EntityTypeManager\Api\Data\EntityTypeInterface;
use Ainnomix\EntityTypeManager\Api\EntityAttributeManagerInterface;
use Magento\Framework\Exception\NotFoundException;
use Magento\Framework\Registry;

class Builder
{

    /**
     * @var Registry
     */
    protected $registry;

    /**
     * @var EntityAttributeManagerInterface
     */
    protected $entityTypeManager;

    /**
     * @var Attribute
     */
    protected $entityAttributeInstance;

    public function __construct(Registry $registry, EntityAttributeManagerInterface $entityTypeManager)
    {
        $this->registry = $registry;
        $this->entityTypeManager = $entityTypeManager;
    }

    /**
     * @param RequestInterface    $request
     * @param EntityTypeInterface $entityType
     * @param string              $attributeFiledName
     *
     * @return Attribute
     *
     * @throws NotFoundException
     */
    public function build(RequestInterface $request, EntityTypeInterface $entityType, $attributeFiledName = 'attribute_id')
    {
        if ($this->entityAttributeInstance) {
            return $this->entityAttributeInstance;
        }

        $entityAttributeId = (int) $request->getParam($attributeFiledName, null);
        $entityAttributeInstance = $this->entityTypeManager->get($entityAttributeId, $entityType);

        if ($entityAttributeId && !$entityAttributeInstance->getEntityTypeId()) {
            throw new NotFoundException(__('Requested entity type "%1" does not exist', $entityAttributeId));
        }

        $this->registry->register('entity_attribute', $entityAttributeInstance);

        return $this->entityAttributeInstance = $entityAttributeInstance;
    }
}
