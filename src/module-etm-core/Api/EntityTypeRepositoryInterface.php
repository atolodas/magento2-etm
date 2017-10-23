<?php

namespace Ainnomix\EtmCore\Api;

use Ainnomix\EtmCore\Api\Data\EntityTypeInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Interface for Entity Type Repository
 */
interface EntityTypeRepositoryInterface
{

    /**
     * Save and update entity type instance
     *
     * @param EntityTypeInterface $entity Entity type instance
     *
     * @return EntityTypeInterface
     */
    public function save(EntityTypeInterface $entity);

    /**
     * Get entity type by code
     *
     * @param string $entityTypeCode Entity type code
     *
     * @return EntityTypeInterface
     *
     * @throws NoSuchEntityException
     */
    public function get($entityTypeCode);

    /**
     * Get entity type by ID
     *
     * @param int $entityTypeId Entity type ID
     *
     * @return EntityTypeInterface
     *
     * @throws NoSuchEntityException
     */
    public function getById($entityTypeId);

    /**
     * Delete entity type instance
     *
     * @param EntityTypeInterface $entity Entity type instance
     *
     * @return void
     */
    public function delete(EntityTypeInterface $entity);

    /**
     * Delete entity type instance by ID
     *
     * @param int $entityTypeId Entity type ID
     *
     * @return void
     *
     * @throws NoSuchEntityException
     */
    public function deleteById($entityTypeId);

    public function getList(SearchCriteriaInterface $searchCriteria);
}
