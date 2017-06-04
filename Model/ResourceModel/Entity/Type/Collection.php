<?php

namespace Ainnomix\EntityTypeManager\Model\ResourceModel\Entity\Type;

class Collection extends \Magento\Eav\Model\ResourceModel\Entity\Type\Collection
{

    use CollectionTrait;

    protected function _construct()
    {
        $this->_init('Ainnomix\EntityTypeManager\Model\Entity\Type', 'Ainnomix\EntityTypeManager\Model\ResourceModel\Entity\Type');
    }
}
