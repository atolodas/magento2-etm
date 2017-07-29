<?php

namespace Ainnomix\EntityTypeManager\Model\Entity\Type;

use Ainnomix\EntityTypeManager\Api\Data\EntityTypeInterface;
use Ainnomix\EntityTypeManager\Api\Data\EntityTypeInterfaceFactory;
use Ainnomix\EntityTypeManager\Api\EntityTypeRepositoryInterface;
use Ainnomix\EntityTypeManager\Model\ResourceModel\Entity\Type as ResourceModel;
use Ainnomix\EntityTypeManager\Setup\EntityTypeSetup;
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

    /**
     * @var EntityTypeSetup
     */
    protected $entityTypeSetup;

    public function __construct(
        ResourceModel $entityTypeResource,
        EntityTypeInterfaceFactory $entityTypeFactory,
        EntityTypeSetup $entityTypeSetup
    ) {
        $this->entityTypeResource = $entityTypeResource;
        $this->entityTypeFactory = $entityTypeFactory;
        $this->entityTypeSetup = $entityTypeSetup;
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
        if ($entityType->getEntityTypeId()) {
            $this->entityTypeResource->save($entityType);
        } else {
            $this->entityTypeSetup->installEntityType($entityType->getEntityTypeCode(), $entityType->getData());
            $this->entityTypeResource->loadByCode($entityType, $entityType->getEntityTypeCode());
        }
    }

    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        // TODO: Implement getList() method.
    }

    public function delete(EntityTypeInterface $entityType)
    {
        $this->entityTypeResource->delete($entityType);
    }

    public function deleteById($entityTypeId)
    {
        $entityType = $this->getById($entityTypeId);
        $this->entityTypeResource->delete($entityType);
    }
}
