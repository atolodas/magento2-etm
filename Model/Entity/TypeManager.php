<?php

namespace Ainnomix\EntityTypeManager\Model\Entity;

use Magento\Backend\Block\Menu;
use Magento\Framework\App\CacheInterface;
use Magento\Framework\App\Cache\Type\Config;
use Ainnomix\EntityTypeManager\Api\Data\EntityTypeInterface;
use Ainnomix\EntityTypeManager\Api\EntityTypeManagerInterface;
use Ainnomix\EntityTypeManager\Api\EntityTypeRepositoryInterface;
use Ainnomix\EntityTypeManager\Api\Data\EntityTypeInterfaceFactory;
use Magento\Framework\Exception\NoSuchEntityException;

class TypeManager implements EntityTypeManagerInterface
{

    /**
     * @var CacheInterface
     */
    protected $cacheManager;

    /**
     * @var EntityTypeRepositoryInterface
     */
    protected $entityTypeRepository;

    /**
     * @var EntityTypeInterfaceFactory
     */
    protected $entityTypeFactory;

    public function __construct(
        CacheInterface $cacheManager,
        EntityTypeRepositoryInterface $entityTypeRepository,
        EntityTypeInterfaceFactory $entityTypeFactory
    ) {
        $this->cacheManager = $cacheManager;
        $this->entityTypeRepository = $entityTypeRepository;
        $this->entityTypeFactory = $entityTypeFactory;
    }

    public function save(EntityTypeInterface $entityType)
    {
        $this->entityTypeRepository->save($entityType);
        $this->cacheManager->clean([Config::CACHE_TAG, Menu::CACHE_TAGS]);
    }

    public function delete(EntityTypeInterface $entityType)
    {
        $this->entityTypeRepository->delete($entityType);
        $this->cacheManager->clean([Config::CACHE_TAG, Menu::CACHE_TAGS]);
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
