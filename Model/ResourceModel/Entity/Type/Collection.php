<?php

namespace Ainnomix\EntityTypeManager\Model\ResourceModel\Entity\Type;

use Magento\Eav\Model\ResourceModel\Entity\Type\Collection as EavEntityTypeCollection;

class Collection extends EavEntityTypeCollection
{

    protected function _construct()
    {
        $this->_init('Ainnomix\EntityTypeManager\Model\Entity\Type', 'Ainnomix\EntityTypeManager\Model\ResourceModel\Entity\Type');

        $this->_setIdFieldName($this->getResource()->getIdFieldName());
    }

    protected function _beforeLoad()
    {
        $this->join(
            ['etm' => $this->getResource()->getAdditionalEntityTypeTable()],
            sprintf('main_table.%s = etm.%s', $this->getIdFieldName(), $this->getIdFieldName()),
            $this->getResource()->getAdditionalEntityTypeFields()
        );

        return parent::_beforeLoad();
    }
}
