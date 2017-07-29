<?php

namespace Ainnomix\EntityTypeManager\Api;

use Ainnomix\EntityTypeManager\Api\Data\EntityTypeInterface;

interface EntityAttributeManagerInterface
{

    /**
     * @param $attribute
     * @param EntityTypeInterface $entityType
     * @return \Magento\Eav\Model\Entity\Attribute
     */
    public function get($attribute, EntityTypeInterface $entityType);
}
