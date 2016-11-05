<?php

namespace Ainnomix\EntityTypeManager\Model\Entity;

use Ainnomix\EntityTypeManager\Api\EntityTypeManagerInterface;
use Ainnomix\EntityTypeManager\Api\EntityTypeRepositoryInterface;
use Magento\Eav\Model\Entity\TypeFactory;
use Magento\Framework\Exception\NoSuchEntityException;

class TypeManager implements EntityTypeManagerInterface
{

    /**
     * @var EntityTypeRepositoryInterface
     */
    protected $entityTypeRepository;

    /**
     * @var TypeFactory
     */
    protected $entityTypeFactory;

    public function __construct(
        EntityTypeRepositoryInterface $entityTypeRepository,
        TypeFactory $entityTypeFactory
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
