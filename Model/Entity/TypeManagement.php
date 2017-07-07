<?php

namespace Ainnomix\EntityTypeManager\Model\Entity;

use Ainnomix\EntityTypeManager\Api\Data\EntityTypeInterface;
use Ainnomix\EntityTypeManager\Api\Data\EntityTypeInterfaceFactory;
use Ainnomix\EntityTypeManager\Api\EntityTypeManagementInterface;
use Ainnomix\EntityTypeManager\Api\EntityTypeRepositoryInterface;
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
    public function get($entityTypeId)
    {
        try {
            $entityType = is_int($entityTypeId)
                ? $this->entityTypeRepository->getById($entityTypeId) : $this->entityTypeRepository->get($entityTypeId);
        } catch (NoSuchEntityException $e) {
            $entityType = $this->entityTypeFactory->create();
        }

        return $entityType;
    }
}
