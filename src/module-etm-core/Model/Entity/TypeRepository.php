<?php

namespace Ainnomix\EtmCore\Model\Entity;

use Ainnomix\EtmCore\Api\Data\EntityTypeInterface;
use Ainnomix\EtmCore\Api\Data\EntityTypeInterfaceFactory;
use Ainnomix\EtmCore\Api\EntityTypeRepositoryInterface;
use Ainnomix\EtmCore\Model\ResourceModel\Entity\Type as TypeResource;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\NoSuchEntityException;

class TypeRepository implements EntityTypeRepositoryInterface
{

    /**
     * @var EntityTypeInterfaceFactory
     */
    protected $typeFactory;

    /**
     * @var TypeResource
     */
    protected $resource;

    public function __construct(
        EntityTypeInterfaceFactory $typeFactory,
        TypeResource $resource
    ) {
        $this->typeFactory = $typeFactory;
        $this->resource = $resource;
    }

    public function save(EntityTypeInterface $entity)
    {
        $this->resource->save($entity);

        return $entity;
    }

    public function get($entityTypeCode)
    {
        $entity = $this->typeFactory->create();
        $this->resource->loadByCode($entity, $entityTypeCode);

        if (!$entity->getEntityTypeId()) {
            throw new NoSuchEntityException('Requested entity type doesn\'t exist');
        }

        return $entity;
    }

    public function getById($entityTypeId)
    {
        $entity = $this->typeFactory->create();
        $this->resource->load($entity, $entityTypeId);

        if (!$entity->getEntityTypeId()) {
            throw new NoSuchEntityException(__('Requested entity type doesn\'t exist'));
        }

        return $entity;
    }

    public function delete(EntityTypeInterface $entity)
    {
        $this->resource->delete($entity);
    }

    public function deleteById($entityTypeId)
    {
        $entity = $this->getById($entityTypeId);
        $this->delete($entity);
    }

    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        // TODO: Implement getList() method.
    }
}
