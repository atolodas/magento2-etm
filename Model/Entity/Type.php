<?php

namespace Ainnomix\EntityTypeManager\Model\Entity;

use Ainnomix\EntityTypeManager\Api\Data\EntityTypeInterface;

class Type extends \Magento\Eav\Model\Entity\Type implements EntityTypeInterface
{
    public function getEntityTypeName()
    {
        return $this->getData('entity_type_name');
    }

    public function getIsCustom()
    {
        return $this->getData('is_custom');
    }
}
