<?php

namespace Ainnomix\EtmCore\Model\Entity;

use Ainnomix\EtmCore\Api\Data\EntityTypeInterface;
use Ainnomix\EtmCore\Api\Data\EntityTypeInterfaceFactory;
use Ainnomix\EtmCore\Api\EntityTypeManagementInterface;
use Ainnomix\EtmCore\Api\EntityTypeRepositoryInterface;
use Magento\Framework\Exception\NoSuchEntityException;

class TypeManagement implements EntityTypeManagementInterface
{

    protected $entityTypeRepository;

    protected $entityTypeFactory;

    public function __construct(
        EntityTypeRepositoryInterface $entityTypeRepository,
        EntityTypeInterfaceFactory $entityTypeFactory
    ) {
        $this->entityTypeRepository = $entityTypeRepository;
        $this->entityTypeFactory = $entityTypeFactory;
    }

    /**
     * @param string|int $entityTypeId
     *
     * @return EntityTypeInterface
     */
    public function get($entityTypeId )
    {
        try {
            $entityType = is_int($entityTypeId)
                ? $this->entityTypeRepository->getById($entityTypeId) : $this->entityTypeRepository->get($entityTypeId);
        } catch (NoSuchEntityException $e) {
            $entityType = $this->entityTypeFactory->create();
        }

        return $entityType;
    }

    /**
     * @param EntityTypeInterface $entityType
     *
     * @return EntityTypeInterface
     */
    public function save(EntityTypeInterface $entityType)
    {
        return $this->entityTypeRepository->save($entityType);
    }
}
