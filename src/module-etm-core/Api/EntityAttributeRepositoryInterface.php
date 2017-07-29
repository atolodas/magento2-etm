<?php

namespace Ainnomix\EntityTypeManager\Api;

interface EntityAttributeRepositoryInterface
{

    public function get($entityTypeCode, $attributeCode);
}
