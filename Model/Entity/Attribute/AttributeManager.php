<?php

namespace Ainnomix\EntityTypeManager\Model\Entity\Attribute;

use Ainnomix\EntityTypeManager\Api\Data\EntityTypeInterface;
use Ainnomix\EntityTypeManager\Api\EntityAttributeManagerInterface;
use Ainnomix\EntityTypeManager\Api\EntityAttributeRepositoryInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Eav\Model\Entity\AttributeFactory;

class AttributeManager implements EntityAttributeManagerInterface
{

    /**
     * @var EntityAttributeRepositoryInterface
     */
    protected $attributeRepository;

    /**
     * @var AttributeFactory
     */
    protected $attributeFactory;

    public function __construct(EntityAttributeRepositoryInterface $attributeRepository, AttributeFactory $attributeFactory)
    {
        $this->attributeRepository = $attributeRepository;
        $this->attributeFactory = $attributeFactory;
    }

    public function get($attribute, EntityTypeInterface $entityType)
    {
        try {
            if (is_numeric($attribute)) {
                $attributeModel = $this->attributeRepository->getById($attribute, $entityType);
            } else {
                $attributeModel = $this->attributeRepository->get($attribute, $entityType);
            }
        } catch (NoSuchEntityException $e) {
            $attributeModel = $this->attributeFactory->create()->setEntityTypeId($entityType->getEntityTypeId());
        }

        return $attributeModel;
    }
}
