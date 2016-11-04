<?php

namespace Ainnomix\EntityManager\Model\Entity\Type;


use Ainnomix\EntityManager\Api\Data\EntityTypeInterface;
use Ainnomix\EntityManager\Api\EntityTypeRepositoryInterface;
use Magento\Eav\Model\Entity\TypeFactory;
use Magento\Eav\Model\ResourceModel\Entity\Type;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\NoSuchEntityException;

class EntityTypeRepository implements EntityTypeRepositoryInterface
{

    /**
     * @var Type
     */
    private $entityTypeResource;
    /**
     * @var TypeFactory
     */
    private $entityTypeFactory;

    public function __construct(
        Type $entityTypeResource,
        TypeFactory $entityTypeFactory
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
        // TODO: Implement save() method.
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
