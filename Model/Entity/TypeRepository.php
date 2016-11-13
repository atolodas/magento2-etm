<?php

namespace Ainnomix\EntityTypeManager\Model\Entity;

use Ainnomix\EntityTypeManager\Api\Data\EntityTypeInterface;
use Ainnomix\EntityTypeManager\Api\Data\EntityTypeInterfaceFactory;
use Ainnomix\EntityTypeManager\Api\EntityTypeRepositoryInterface;
use Ainnomix\EntityTypeManager\Model\ResourceModel\Entity\Type as ResourceModel;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\NoSuchEntityException;

class TypeRepository implements EntityTypeRepositoryInterface
{

    /**
     * @var ResourceModel
     */
    protected $entityTypeResource;
    
    /**
     * @var EntityTypeInterfaceFactory
     */
    protected $entityTypeFactory;

    public function __construct(
        ResourceModel $entityTypeResource,
        EntityTypeInterfaceFactory $entityTypeFactory
    ) {
        $this->entityTypeResource = $entityTypeResource;
        $this->entityTypeFactory = $entityTypeFactory;
    }

    public function get($entityTypeCode)
    {
        $entityType = $this->entityTypeFactory->create();
        $this->entityTypeResource->loadByCode($entityType, $entityTypeCode);

        if (!$entityType->getId()) {
            throw new NoSuchEntityException();
        }

        return $entityType;
    }

    public function getById($id)
    {
        $entityType = $this->entityTypeFactory->create();
        $this->entityTypeResource->load($entityType, $id);

        if (!$entityType->getId()) {
            throw new NoSuchEntityException();
        }

        return $entityType;
    }

    public function save(EntityTypeInterface $entityType)
    {
        $this->entityTypeResource->save($entityType);
    }

    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        // TODO: Implement getList() method.
    }

    public function delete(EntityTypeInterface $entityType)
    {
        // TODO: Implement delete() method.
    }

    public function deleteById($entityTypeId)
    {
        // TODO: Implement deleteById() method.
    }
}
