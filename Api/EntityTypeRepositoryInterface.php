<?php

namespace Ainnomix\EntityTypeManager\Api;

use Ainnomix\EntityTypeManager\Api\Data\EntityTypeInterface;
use Magento\Framework\Api\SearchCriteriaInterface;

interface EntityTypeRepositoryInterface
{

    public function save(EntityTypeInterface $entity);

    public function get($entityTypeCode);

    public function getById($entityTypeId);

    public function delete(EntityTypeInterface $entity);

    public function deleteById($entityTypeId);

    public function getList(SearchCriteriaInterface $searchCriteria);
}
