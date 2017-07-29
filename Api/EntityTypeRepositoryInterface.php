<?php

namespace Ainnomix\EntityTypeManager\Api;


use Ainnomix\EntityTypeManager\Api\Data\EntityTypeInterface;
use Magento\Framework\Api\SearchCriteriaInterface;

interface EntityTypeRepositoryInterface
{

    public function save(EntityTypeInterface $entityType);

    public function getList(SearchCriteriaInterface $searchCriteria);

    public function get($entityTypeCode);
    
    public function getById($entityTypeId);
    
    public function delete(EntityTypeInterface $entityType);

    public function deleteById($entityTypeId);
}
