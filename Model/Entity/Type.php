<?php

namespace Ainnomix\EntityTypeManager\Model\Entity;

use Ainnomix\EntityTypeManager\Api\Data\EntityTypeInterface;
use Magento\Eav\Model\Entity\Type as EavEntityType;

class Type extends EavEntityType implements EntityTypeInterface
{

    protected function _construct()
    {
        $this->_init('Ainnomix\EntityTypeManager\Model\ResourceModel\Entity\Type');
    }
}
