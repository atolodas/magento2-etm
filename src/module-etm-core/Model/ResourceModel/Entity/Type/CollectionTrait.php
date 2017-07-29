<?php

namespace Ainnomix\EntityTypeManager\Model\ResourceModel\Entity\Type;

trait CollectionTrait
{

    protected function _beforeLoad()
    {
        $this->addFieldToFilter('is_custom', 1);

        return parent::_beforeLoad();
    }
}
