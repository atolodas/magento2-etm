<?php

namespace Ainnomix\EntityTypeManager\Model\Entity\Attribute;

use Ainnomix\EntityTypeManager\Api\Data\EntityTypeInterface;
use Ainnomix\EntityTypeManager\Api\EntityAttributeRepositoryInterface;
use Magento\Eav\Model\Entity\AttributeFactory;
use Magento\Eav\Model\ResourceModel\Entity\Attribute;
use Magento\Framework\Exception\NoSuchEntityException;

class AttributeRepository implements EntityAttributeRepositoryInterface
{

    /**
     * @var Attribute
     */
    protected $attributeResource;

    /**
     * @var AttributeFactory
     */
    protected $attributeFactory;

    public function __construct(Attribute $attributeResource, AttributeFactory $attributeFactory)
    {
        $this->attributeResource = $attributeResource;
        $this->attributeFactory = $attributeFactory;
    }

    public function get($attributeCode, EntityTypeInterface $entityType)
    {
        $attributeModel = $this->attributeFactory->create();
        $attributeModel->setEntityTypeId($entityType->getEntityTypeId());

        $this->attributeResource->loadByCode($attributeModel, $entityType->getEntityTypeId(), $attributeCode);

        if (!$attributeModel->getId()) {
            throw new NoSuchEntityException();
        }

        return $attributeModel;
    }

    public function getById($attributeId, EntityTypeInterface $entityType)
    {
        $attributeModel = $this->attributeFactory->create();
        $attributeModel->setEntityTypeId($entityType->getEntityTypeId());

        $this->attributeResource->load($attributeModel, $attributeId);
        
        if (!$attributeModel->getId()) {
            throw new NoSuchEntityException();
        }
        
        return $attributeModel;
    }
}
