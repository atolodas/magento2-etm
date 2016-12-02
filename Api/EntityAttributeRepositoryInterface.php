<?php

namespace Ainnomix\EntityTypeManager\Api;

use Ainnomix\EntityTypeManager\Api\Data\EntityTypeInterface;

interface EntityAttributeRepositoryInterface
{

    public function get($attributeCode, EntityTypeInterface $entityType);
    
    public function getById($attributeId, EntityTypeInterface $entityType);
}