<?php

namespace Ainnomix\EntityManager\Model\Entity\Type;


use Ainnomix\EntityManager\Api\EntityTypeManagerInterface;
use Ainnomix\EntityManager\Api\EntityTypeRepositoryInterface;
use Magento\Eav\Model\Entity\TypeFactory;
use Magento\Framework\Exception\NoSuchEntityException;

class EntityTypeManager implements EntityTypeManagerInterface
{

    /**
     * @var EntityTypeRepositoryInterface
     */
    private $entityTypeRepository;
    /**
     * @var TypeFactory
     */
    private $entityTypeFactory;

    public function __construct(
        EntityTypeRepositoryInterface $entityTypeRepository,
        TypeFactory $entityTypeFactory
    ) {
        $this->entityTypeRepository = $entityTypeRepository;
        $this->entityTypeFactory = $entityTypeFactory;
    }
    
    public function getEntityType($entityTypeCode)
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
