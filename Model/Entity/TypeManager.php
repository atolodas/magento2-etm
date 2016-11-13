<?php

namespace Ainnomix\EntityTypeManager\Model\Entity;

use Ainnomix\EntityTypeManager\Api\EntityTypeManagerInterface;
use Ainnomix\EntityTypeManager\Api\EntityTypeRepositoryInterface;
use Ainnomix\EntityTypeManager\Api\Data\EntityTypeInterfaceFactory;
use Magento\Framework\Exception\NoSuchEntityException;

class TypeManager implements EntityTypeManagerInterface
{

    /**
     * @var EntityTypeRepositoryInterface
     */
    protected $entityTypeRepository;

    /**
     * @var EntityTypeInterfaceFactory
     */
    protected $entityTypeFactory;

    public function __construct(
        EntityTypeRepositoryInterface $entityTypeRepository,
        EntityTypeInterfaceFactory $entityTypeFactory
    ) {
        $this->entityTypeRepository = $entityTypeRepository;
        $this->entityTypeFactory = $entityTypeFactory;
    }
    
    public function get($entityTypeCode)
    {
        try {
            if (is_int($entityTypeCode)) {
                $entityType = $this->entityTypeRepository->getById($entityTypeCode);
            } else {
                $entityType = $this->entityTypeRepository->get($entityTypeCode);
            }
        } catch (NoSuchEntityException $e) {
            $entityType = $this->entityTypeFactory->create();
        }

        return $entityType;
    }
}
